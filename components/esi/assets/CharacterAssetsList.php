<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 10.10.2018
 * Time: 22:06
 */

namespace app\components\esi\assets;

class CharacterAssetsList
{
    public $stations = [];
    public $solarSystems = [];
    public $other = [];

    /**
     * CharacterAssetsList constructor.
     * @param CharacterAssetItem[] $assets
     */
    public function __construct(array $assets)
    {
        foreach ($assets as $asset) {
            if ($asset->locationType == AssetItem::LOCATION_TYPE_STATION) {
                $this->stations[$asset->locationId][] = $asset;
                if ($asset->locationType == AssetItem::LOCATION_TYPE_SOLAR_SYSTEM) {
                    $this->solarSystems[$asset->locationId][] = $asset;
                } else {
                    $this->other[$asset->locationId][] = $asset;
                }
            }
        }
    }
}
