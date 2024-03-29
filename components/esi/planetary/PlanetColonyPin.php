<?php

namespace app\components\esi\planetary;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\components\esi\SearchFactory;
use app\components\esi\universe\Type;
use app\models\PiSchematicInput;
use DateTime;

class PlanetColonyPin extends EVEObject
{
    /**
     * @var PlanetColonyPinContent[]
     */
    public $contents;

    /**
     * @var DateTime
     */
    public $expiryTime;

    /**
     * @var PlanetColonyExtractor
     */
    public $extractorDetails;

    /**
     * @var array
     */
    public $factoryDetails;

    /**
     * @var DateTime
     */
    public $installTime;

    /**
     * @var DateTime
     */
    public $lastCycleStart;

    /**
     * @var float
     */
    public $latitude;

    /**
     * @var float
     */
    public $longitude;

    /**
     * @var int
     */
    public $pinId;

    /**
     * @var int
     */
    public $schematicId;

    /**
     * @var int
     */
    public $typeId;

    /**
     * @var Type
     */
    private $type;

    /**
     * @var PiSchematicInput[]
     */
    private $schematicInput = [];

    /**
     * @var Type
     */
    private $schematicOutput;

    public function __construct(array $data)
    {
        parent::__construct($data);

        if ($this->contents && is_array($this->contents)) {
            foreach ($this->contents as &$content) {
                $content = new PlanetColonyPinContent($content);
            }
        }

        if ($this->extractorDetails) {
            $this->extractorDetails = new PlanetColonyExtractor($this->extractorDetails);
        }
        if ($this->expiryTime) {
            $this->expiryTime = new DateTime($this->expiryTime);
        }
        if ($this->installTime) {
            $this->installTime = new DateTime($this->installTime);
        }
        if ($this->lastCycleStart) {
            $this->lastCycleStart = new DateTime($this->lastCycleStart);
        }

        /**
         * @todo drop
         */
        $this->type = EVE::universe()->type($this->typeId);
    }

    /**
     * @return Type
     */
    public function type()
    {
        if (!$this->type) {
            $this->type = EVE::universe()->type($this->typeId);
        }

        return $this->type;
    }

    /**
     * @return bool
     */
    public function isExtractor()
    {
        return (bool) $this->extractorDetails;
    }

    /**
     * @return bool
     */
    public function isCommandCenter()
    {
        return (bool) strstr($this->type()->name, 'Command Center');
    }

    /**
     * @return bool
     */
    public function isLaunchpad()
    {
        return (bool) strstr($this->type()->name, 'Launchpad');
    }

    /**
     * @return bool
     */
    public function isExtractorControlUnit()
    {
        return (bool) strstr($this->type()->name, 'Extractor Control Unit');
    }

    /**
     * @return bool
     */
    public function isStorageFacility()
    {
        return (bool) strstr($this->type()->name, 'Storage Facility');
    }

    /**
     * @return bool
     */
    public function isBasicIndustryFacility()
    {
        return (bool) strstr($this->type()->name, 'Basic Industry Facility');
    }

    /**
     * @return bool
     */
    public function isAdvancedIndustryFacility()
    {
        return (bool) strstr($this->type()->name, 'Advanced Industry Facility');
    }

    /**
     * @return bool
     */
    public function isHighTechProductionPlant()
    {
        return (bool) strstr($this->type()->name, 'High-Tech Production Plant');
    }

    /**
     * @return bool
     */
    public function isIndustryFacility()
    {
        return $this->isBasicIndustryFacility() || $this->isAdvancedIndustryFacility() || $this->isHighTechProductionPlant();
    }

    /**
     * @return string
     */
    public function getPinColor()
    {
        return $this->isIndustryFacility() ? '#ffb71e' : '#008888';
    }

    /**
     * @return float
     */
    public function getContentsVolume()
    {
        if (!$this->contents) {
            return 0;
        }

        $volume = 0;
        foreach ($this->contents as $content) {
            $volume += $content->amount * $content->type()->volume;
        }

        return $volume;
    }

    /**
     * @return PiSchematicInput[]
     */
    public function schematicInput()
    {
        if (!$this->isIndustryFacility() || !$this->schematicId) {
            return [];
        }

        if (!$this->schematicInput) {
            $type = $this->schematicOutput();
            if (!$type) {
                return [];
            }

            $this->schematicInput = PiSchematicInput::find()->where(['output_type_id' => $type->typeId])->all();
        }

        return $this->schematicInput;
    }

    public function schematicOutput()
    {
        if (!$this->isIndustryFacility() || !$this->schematicId) {
            return null;
        }

        if (!$this->schematicOutput) {
            $schematic = EVE::universe()->planetarySchematic($this->schematicId);
            $typesIds = EVE::universe()->search($schematic->schematicName, [SearchFactory::CATEGORY_INVENTORY_TYPE], true)
                ->inventoryType;

            if (!$typesIds) {
                return [];
            }

            $types = [];
            foreach ($typesIds as $typeId) {
                $types[] = EVE::universe()->type($typeId);
            }

            $types = array_filter($types, function (Type $type) use ($schematic) {
                return $type->name === $schematic->schematicName;
            });

            /**
             * @var Type $type
             */
            $this->schematicOutput = reset($types);
        }

        return $this->schematicOutput;
    }
}
