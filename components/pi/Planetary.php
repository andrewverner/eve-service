<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.11.2018
 * Time: 11:56
 */

namespace app\components\pi;

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
     * @var array
     */
    private $base = [
        Material::MATERIAL_BACTERIA => [Material::RAW_MATERIAL_MICROORGANISMS],
        Material::MATERIAL_BIOFUELS => [Material::RAW_MATERIAL_CARBON_COMPOUNDS],
        Material::MATERIAL_BIOMASS => [Material::RAW_MATERIAL_PLANKTIC_COLONIES],
        Material::MATERIAL_CHIRAL_STRUCTURES => [Material::RAW_MATERIAL_NON_CS_CRYSTALS],
        Material::MATERIAL_ELECTROLYTES => [Material::RAW_MATERIAL_IONIC_SOLUTIONS],
        Material::MATERIAL_INDUSTRIAL_FIBERS => [Material::RAW_MATERIAL_AUTOTROPHS],
        Material::MATERIAL_OXIDIZING_COMPOUND => [Material::RAW_MATERIAL_REACTIVE_GAS],
        Material::MATERIAL_OXYGEN => [Material::RAW_MATERIAL_NOBLE_GAS],
        Material::MATERIAL_PLASMOIDS => [Material::RAW_MATERIAL_SUSPENDED_PLASMA],
        Material::MATERIAL_PRECIOUS_METALS => [Material::RAW_MATERIAL_NOBLE_METALS],
        Material::MATERIAL_PROTEINS => [Material::RAW_MATERIAL_COMPLEX_ORGANISMS],
        Material::MATERIAL_REACTIVE_METALS => [Material::RAW_MATERIAL_BASE_METALS],
        Material::MATERIAL_SILICON => [Material::RAW_MATERIAL_FELSIC_MAGMA],
        Material::MATERIAL_TOXIC_METALS => [Material::RAW_MATERIAL_HEAVY_METALS],
        Material::MATERIAL_WATER => [Material::RAW_MATERIAL_AQUEOUS_LIQUIDS],
    ];

    private $tier1 = [
        Material::TIER1_BIOCELLS => [
            Material::MATERIAL_BIOFUELS,
            Material::MATERIAL_PRECIOUS_METALS,
        ],
        Material::TIER1_CONSTRUCTION_BLOCKS => [
            Material::MATERIAL_REACTIVE_METALS,
            Material::MATERIAL_TOXIC_METALS,
        ],
        Material::TIER1_CONSUMER_ELECTRONICS => [
            Material::MATERIAL_TOXIC_METALS,
            Material::MATERIAL_CHIRAL_STRUCTURES,
        ],
        Material::TIER1_COOLANT => [
            Material::MATERIAL_ELECTROLYTES,
            Material::MATERIAL_WATER,
        ],
        Material::TIER1_ENRICHED_URANIUM => [
            Material::MATERIAL_PRECIOUS_METALS,
            Material::MATERIAL_TOXIC_METALS,
        ],
        Material::TIER1_FERTILIZER => [
            Material::MATERIAL_BACTERIA,
            Material::MATERIAL_PROTEINS,
        ],
        Material::TIER1_GENETICALLY_ENHANCED_LIVESTOCK => [
            Material::MATERIAL_PROTEINS,
            Material::MATERIAL_BIOMASS,
        ],
        Material::TIER1_LIVESTOCK => [
            Material::MATERIAL_PROTEINS,
            Material::MATERIAL_BIOFUELS,
        ],
        Material::TIER1_MECHANICAL_PARTS => [
            Material::MATERIAL_REACTIVE_METALS,
            Material::MATERIAL_PRECIOUS_METALS,
        ],
        Material::TIER1_MICROFIBER_SHIELDING => [
            Material::MATERIAL_INDUSTRIAL_FIBERS,
            Material::MATERIAL_SILICON,
        ],
        Material::TIER1_MINIATURE_ELECTRONICS => [
            Material::MATERIAL_CHIRAL_STRUCTURES,
            Material::MATERIAL_SILICON,
        ],
        Material::TIER1_NANITES => [
            Material::MATERIAL_BACTERIA,
            Material::MATERIAL_REACTIVE_METALS,
        ],
        Material::TIER1_OXIDES => [
            Material::MATERIAL_OXIDIZING_COMPOUND,
            Material::MATERIAL_OXYGEN,
        ],
        Material::TIER1_POLYARAMIDS => [
            Material::MATERIAL_OXIDIZING_COMPOUND,
            Material::MATERIAL_INDUSTRIAL_FIBERS,
        ],
        Material::TIER1_POLYTEXTILES => [
            Material::MATERIAL_BIOFUELS,
            Material::MATERIAL_INDUSTRIAL_FIBERS,
        ],
        Material::TIER1_ROCKET_FUEL => [
            Material::MATERIAL_PLASMOIDS,
            Material::MATERIAL_ELECTROLYTES,
        ],
        Material::TIER1_SILICATE_GLASS => [
            Material::MATERIAL_OXIDIZING_COMPOUND,
            Material::MATERIAL_SILICON,
        ],
        Material::TIER1_SUPERCONDUCTORS => [
            Material::MATERIAL_PLASMOIDS,
            Material::MATERIAL_WATER,
        ],
        Material::TIER1_SUPERTENSILE_PLASTICS => [
            Material::MATERIAL_OXYGEN,
            Material::MATERIAL_BIOMASS,
        ],
        Material::TIER1_SYNTHETIC_OIL => [
            Material::MATERIAL_ELECTROLYTES,
            Material::MATERIAL_OXYGEN,
        ],
        Material::TIER1_TEST_CULTURES => [
            Material::MATERIAL_BACTERIA,
            Material::MATERIAL_WATER,
        ],
        Material::TIER1_TRANSMITTER => [
            Material::MATERIAL_PLASMOIDS,
            Material::MATERIAL_CHIRAL_STRUCTURES,
        ],
        Material::TIER1_VIRAL_AGENT => [
            Material::MATERIAL_BACTERIA,
            Material::MATERIAL_BIOMASS,
        ],
        Material::TIER1_WATER_COOLED_CPU => [
            Material::MATERIAL_REACTIVE_METALS,
            Material::MATERIAL_WATER,
        ],
    ];

    private $tier2 = [
        Material::TIER2_BIOTECH_RESEARCH_REPORTS => [
            Material::TIER1_NANITES,
            Material::TIER1_LIVESTOCK,
            Material::TIER1_CONSTRUCTION_BLOCKS,
        ],
        Material::TIER2_CAMERA_DRONES => [
            Material::TIER1_SILICATE_GLASS,
            Material::TIER1_ROCKET_FUEL,
        ],
        Material::TIER2_CONDENSATES => [
            Material::TIER1_OXIDES,
            Material::TIER1_COOLANT,
        ],
        Material::TIER2_CRYOPROTECTANT_SOLUTION => [
            Material::TIER1_TEST_CULTURES,
            Material::TIER1_SYNTHETIC_OIL,
            Material::TIER1_FERTILIZER,
        ],
        Material::TIER2_DATA_CHIPS => [
            Material::TIER1_SUPERTENSILE_PLASTICS,
            Material::TIER1_MICROFIBER_SHIELDING,
        ],
        Material::TIER2_GEL_MATRIX_BIOPASTE => [
            Material::TIER1_OXIDES,
            Material::TIER1_BIOCELLS,
            Material::TIER1_SUPERCONDUCTORS,
        ],
        Material::TIER2_GUIDANCE_SYSTEMS => [
            Material::TIER1_WATER_COOLED_CPU,
            Material::TIER1_TRANSMITTER,
        ],
        Material::TIER2_HAZMAT_DETECTION_SYSTEMS => [
            Material::TIER1_POLYTEXTILES,
            Material::TIER1_VIRAL_AGENT,
            Material::TIER1_TRANSMITTER,
        ],
        Material::TIER2_HERMETIC_MEMBRANES => [
            Material::TIER1_POLYARAMIDS,
            Material::TIER1_GENETICALLY_ENHANCED_LIVESTOCK,
        ],
        Material::TIER2_HIGH_TECH_TRANSMITTERS => [
            Material::TIER1_POLYARAMIDS,
            Material::TIER1_TRANSMITTER,
        ],
        Material::TIER2_INDUSTRIAL_EXPLOSIVES => [
            Material::TIER1_FERTILIZER,
            Material::TIER1_POLYTEXTILES,
        ],
        Material::TIER2_NEOCOMS => [
            Material::TIER1_BIOCELLS,
            Material::TIER1_SILICATE_GLASS,
        ],
        Material::TIER2_NUCLEAR_REACTORS => [
            Material::TIER1_ENRICHED_URANIUM,
            Material::TIER1_MICROFIBER_SHIELDING,
        ],
        Material::TIER2_PLANETARY_VEHICLES => [
            Material::TIER1_SUPERTENSILE_PLASTICS,
            Material::TIER1_MECHANICAL_PARTS,
            Material::TIER1_MINIATURE_ELECTRONICS,
        ],
        Material::TIER2_ROBOTICS => [
            Material::TIER1_MECHANICAL_PARTS,
            Material::TIER1_CONSUMER_ELECTRONICS,
        ],
        Material::TIER2_SMARTFAB_UNITS => [
            Material::TIER1_CONSTRUCTION_BLOCKS,
            Material::TIER1_MINIATURE_ELECTRONICS,
        ],
        Material::TIER2_SUPERCOMPUTERS => [
            Material::TIER1_WATER_COOLED_CPU,
            Material::TIER1_COOLANT,
            Material::TIER1_CONSUMER_ELECTRONICS,
        ],
        Material::TIER2_SYNTHETIC_SYNAPSES => [
            Material::TIER1_SUPERTENSILE_PLASTICS,
            Material::TIER1_TEST_CULTURES,
        ],
        Material::TIER2_TRANSCRANIAL_MICROCONTROLLERS => [
            Material::TIER1_BIOCELLS,
            Material::TIER1_NANITES,
        ],
        Material::TIER2_UKOMI_SUPERCONDUCTORS => [
            Material::TIER1_SYNTHETIC_OIL,
            Material::TIER1_SUPERCONDUCTORS,
        ],
        Material::TIER2_VACCINES => [
            Material::TIER1_LIVESTOCK,
            Material::TIER1_VIRAL_AGENT,
        ],
    ];

    private $tier3 = [
        Material::TIER3_BROADCAST_NODE => [
            Material::TIER2_NEOCOMS,
            Material::TIER2_DATA_CHIPS,
            Material::TIER2_HIGH_TECH_TRANSMITTERS,
        ],
        Material::TIER3_INTEGRITY_RESPONSE_DRONES => [
            Material::TIER2_GEL_MATRIX_BIOPASTE,
            Material::TIER2_HAZMAT_DETECTION_SYSTEMS,
            Material::TIER2_PLANETARY_VEHICLES,
        ],
        Material::TIER3_NANO_FACTORY => [
            Material::TIER2_INDUSTRIAL_EXPLOSIVES,
            Material::MATERIAL_REACTIVE_METALS,
            Material::TIER2_UKOMI_SUPERCONDUCTORS,
        ],
        Material::TIER3_ORGANIC_MORTAR_APPLICATORS => [
            Material::TIER2_CONDENSATES,
            Material::MATERIAL_BACTERIA,
            Material::TIER2_ROBOTICS,
        ],
        Material::TIER3_RECURSIVE_COMPUTING_MODULE => [
            Material::TIER2_SYNTHETIC_SYNAPSES,
            Material::TIER2_GUIDANCE_SYSTEMS,
            Material::TIER2_TRANSCRANIAL_MICROCONTROLLERS,
        ],
        Material::TIER3_SELF_HARMONIZING_POWER_CORE => [
            Material::TIER2_CAMERA_DRONES,
            Material::TIER2_NUCLEAR_REACTORS,
            Material::TIER2_HERMETIC_MEMBRANES,
        ],
        Material::TIER3_STERILE_CONDUITS => [
            Material::TIER2_SMARTFAB_UNITS,
            Material::MATERIAL_WATER,
            Material::TIER2_VACCINES,
        ],
        Material::TIER3_WETWARE_MAINFRAME => [
            Material::TIER2_SUPERCOMPUTERS,
            Material::TIER2_BIOTECH_RESEARCH_REPORTS,
            Material::TIER2_CRYOPROTECTANT_SOLUTION,
        ],
    ];

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
            $this->base = [];
            return;
        }

        foreach ($this->base as $output => $input) {
            foreach ($input as $material) {
                if (!in_array($material, $this->rawMaterials)) {
                    unset($this->base[$output]);
                    continue 2;
                }
            }
        }

        $this->dump = array_merge($this->dump, array_keys($this->base));
    }

    private function exploreTier1Reactions()
    {
        if (!$this->base) {
            $this->tier1 = [];
            return;
        }

        foreach ($this->tier1 as $output => $input) {
            foreach ($input as $material) {
                if (!isset($this->base[$material])) {
                    unset($this->tier1[$output]);
                    continue 2;
                }
            }
        }

        $this->dump = array_merge($this->dump, array_keys($this->tier1));
    }

    private function exploreTier2Reactions()
    {
        if (!$this->tier1) {
            $this->tier2 = [];
            return;
        }

        foreach ($this->tier2 as $output => $input) {
            foreach ($input as $material) {
                if (!isset($this->tier1[$material])) {
                    unset($this->tier2[$output]);
                    continue 2;
                }
            }
        }

        $this->dump = array_merge($this->dump, array_keys($this->tier2));
    }

    private function exploreTier3Reactions()
    {
        if (!$this->tier2 && !$this->base) {
            $this->tier3 = [];
            return;
        }

        foreach ($this->tier3 as $output => $input) {
            foreach ($input as $material) {
                if (!in_array($material, $this->dump)) {
                    unset($this->tier3[$output]);
                    continue 2;
                }
            }
        }

        $this->dump = array_merge($this->dump, array_keys($this->tier3));
    }

    public function getBaseReactions()
    {
        return $this->base;
    }

    public function getTier1Reactions()
    {
        return $this->tier1;
    }

    public function getTier2Reactions()
    {
        return $this->tier2;
    }

    public function getTier3Reactions()
    {
        return $this->tier3;
    }
}
