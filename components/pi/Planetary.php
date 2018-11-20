<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.11.2018
 * Time: 11:56
 */

namespace app\components\pi;

use app\components\esi\EVE;
use app\components\Html;
use app\components\pi\planets\BarrenPlanet;
use app\components\pi\planets\GasPlanet;
use app\components\pi\planets\IcePlanet;
use app\components\pi\planets\LavaPlanet;
use app\components\pi\planets\OceanicPlanet;
use app\components\pi\planets\PlasmaPlanet;
use app\components\pi\planets\StormPlanet;
use app\components\pi\planets\TemperatePlanet;
use app\components\pi\schematics\Schematic;
use yii\helpers\FileHelper;
use yii\web\BadRequestHttpException;

class Planetary
{
    /**
     * @var Planet[]
     */
    private $planets = [];

    /**
     * @var array
     */
    private $rawMaterials = [];

    /**
     * @var array
     */
    private $dump = [];

    /**
     * @var Schematic[]
     */
    private $base;

    /**
     * @var Schematic[]
     */
    private $tier1;

    /**
     * @var Schematic[]
     */
    private $tier2;

    /**
     * @var Schematic[]
     */
    private $tier3;

    private static $schemasDump = [];

    /**
     * @param Planet[] $planets
     */
    public function addPlanet(array $planets)
    {
        $this->planets = $planets;
    }

    /**
     * @throws BadRequestHttpException
     */
    public function explore()
    {
        if (!$this->planets) {
            throw new BadRequestHttpException('Planets list is empty');
        }

        foreach ($this->planets as $planet) {
            $this->rawMaterials = array_merge($this->rawMaterials, $planet->getMaterials());
        }
        $this->rawMaterials = $this->dump = array_unique($this->rawMaterials);
        $this->exploreBaseReactions();
        $this->exploreTier1Reactions();
        $this->exploreTier2Reactions();
        $this->exploreTier3Reactions();
    }

    private function exploreBaseReactions()
    {
        if (!$this->rawMaterials) {
            return;
        }

        /**
         * @return Schematic[]|array|void
         */
        $this->base = $this->importSchematics(
            '@app/components/pi/schematics/base',
            'app\components\pi\schematics\base'
        );

        $this->base = array_filter($this->base, function ($schematic) {
            /**
             * @var Schematic $schematic
             */
            foreach ($schematic::input() as $materialId => $quantity) {
                if (!in_array($materialId, $this->rawMaterials)) {
                    return false;
                }
            }

            return true;
        });
    }

    private function exploreTier1Reactions()
    {
        if (!$this->base) {
            return;
        }

        $this->tier1 = $this->importSchematics(
            '@app/components/pi/schematics/tier1',
            'app\components\pi\schematics\tier1'
        );

        $this->tier1 = array_filter($this->tier1, function ($schematic) {
            /**
             * @var Schematic $schematic
             */
            foreach ($schematic::input() as $materialId => $quantity) {
                if (!in_array($materialId, array_keys($this->base))) {
                    return false;
                }
            }

            return true;
        });
    }

    private function exploreTier2Reactions()
    {
        if (!$this->tier1) {
            return;
        }

        $this->tier2 = $this->importSchematics(
            '@app/components/pi/schematics/tier2',
            'app\components\pi\schematics\tier2'
        );

        $this->tier2 = array_filter($this->tier2, function ($schematic) {
            /**
             * @var Schematic $schematic
             */
            foreach ($schematic::input() as $materialId => $quantity) {
                if (!in_array($materialId, array_keys($this->tier1))) {
                    return false;
                }
            }

            return true;
        });
    }

    private function exploreTier3Reactions()
    {
        if (!$this->tier2 && !$this->base) {
            return;
        }

        $this->tier3 = $this->importSchematics(
            '@app/components/pi/schematics/tier3',
            'app\components\pi\schematics\tier3'
        );

        $this->tier3 = array_filter($this->tier3, function ($schematic) {
            /**
             * @var Schematic $schematic
             */
            foreach ($schematic::input() as $materialId => $quantity) {
                if (!in_array($materialId, array_merge(array_keys($this->tier2), array_keys($this->base)))) {
                    return false;
                }
            }

            return true;
        });
    }

    /**
     * @return Schematic[]
     */
    public function getBaseReactions()
    {
        return $this->base;
    }

    /**
     * @return Schematic[]
     */
    public function getTier1Reactions()
    {
        return $this->tier1;
    }

    /**
     * @return Schematic[]
     */
    public function getTier2Reactions()
    {
        return $this->tier2;
    }

    /**
     * @return Schematic[]
     */
    public function getTier3Reactions()
    {
        return $this->tier3;
    }

    /**
     * @param $pathAlias
     * @param $namespace
     * @return Schematic[]
     * @throws \ReflectionException
     */
    private function importSchematics($pathAlias, $namespace)
    {
        $data = [];
        $schematics = FileHelper::findFiles(\Yii::getAlias($pathAlias), ['only'=>['*.php']]);
        foreach ($schematics as $schematic) {
            $schematicName = basename(str_replace('.php', '', $schematic));
            $r = new \ReflectionClass($namespace . '\\' . $schematicName);
            /**
             * @var Schematic $schematicClass
             */
            $schematicClass = $r->newInstance();
            $data[$schematicClass::typeId()] = $schematicClass;
        }

        return $data;
    }

    public static function getSchemas()
    {
        $planets = [
            'barren' => (new BarrenPlanet())->getMaterials(),
            'gas' => (new GasPlanet())->getMaterials(),
            'ice' => (new IcePlanet())->getMaterials(),
            'lava' => (new LavaPlanet())->getMaterials(),
            'oceanic' => (new OceanicPlanet())->getMaterials(),
            'plasma' => (new PlasmaPlanet())->getMaterials(),
            'storm' => (new StormPlanet())->getMaterials(),
            'temperate' => (new TemperatePlanet())->getMaterials(),
        ];

        $baseSchematics = (new self)->importSchematics(
            '@app/components/pi/schematics/base',
            'app\components\pi\schematics\base'
        );
        $base = [];
        foreach ($baseSchematics as $schematic) {
            $base[$schematic::typeId()] = array_keys($schematic::input());
        }

        $tier1Schematics = (new self)->importSchematics(
            '@app/components/pi/schematics/tier1',
            'app\components\pi\schematics\tier1'
        );
        $tier1 = [];
        foreach ($tier1Schematics as $schematic) {
            $tier1[$schematic::typeId()] = array_keys($schematic::input());
        }

        $tier2Schematics = (new self)->importSchematics(
            '@app/components/pi/schematics/tier2',
            'app\components\pi\schematics\tier2'
        );
        $tier2 = [];
        foreach ($tier2Schematics as $schematic) {
            $tier2[$schematic::typeId()] = array_keys($schematic::input());
        }

        $tier3Schematics = (new self)->importSchematics(
            '@app/components/pi/schematics/tier3',
            'app\components\pi\schematics\tier3'
        );
        $tier3 = [];
        foreach ($tier3Schematics as $schematic) {
            $tier3[$schematic::typeId()] = array_keys($schematic::input());
        }

        return [
            'planets' => $planets,
            'base' => $base,
            'tier1' => $tier1,
            'tier2' => $tier2,
            'tier3' => $tier3,
        ];
    }

    /**
     * @param $id
     * @return mixed|null
     */
    public static function nodeComponents($id)
    {
        if (!self::$schemasDump) {
            $schemas = self::getSchemas();
            unset($schemas['planets']);
            foreach ($schemas as $techLevel => $schemasList) {
                /**
                 * @var Schematic[] $schemasList
                 */
                foreach ($schemasList as $typeId => $inputIds) {
                    self::$schemasDump[$typeId] = $inputIds;
                }
            }
        }

        return self::$schemasDump[$id] ?? null;
    }

    public static function nodeTree($nodeId)
    {
        $type = EVE::universe()->type($nodeId);

        $node = [
            'innerHTML' => Html::img(
                $type->image(32),
                [
                    'data-toggle' => 'popover',
                    'data-placement' => 'bottom',
                    'data-content' => $type->name,
                ]
            )
        ];
        $nodeChildren = self::nodeComponents($nodeId);
        if ($nodeChildren) {
            $children = [];
            foreach ($nodeChildren as $childrenId) {
                $children[] = self::nodeTree($childrenId);
            }
            $node['children'] = $children;
        }

        return $node;
    }
}
