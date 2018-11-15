<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 15.11.18
 * Time: 12:21
 */

namespace app\components\esi\dogma;

use app\components\esi\EVE;

class Dogma
{
    /**
     * @param int $id
     * @return DogmaAttribute|null
     */
    public function attribute($id)
    {
        $request = EVE::request('/dogma/attributes/{attribute_id}/');
        $request->cacheDuration = 3600 * 12;
        $data = $request->send(['attribute_id' => $id]);
        if (!$data) {
            return null;
        }

        return new DogmaAttribute($data);
    }

    /**
     * @param int $id
     * @return DogmaEffect|null
     */
    public function effect($id)
    {
        $request = EVE::request('/dogma/effects/{effect_id}/');
        $request->cacheDuration = 3600 * 12;
        $data = $request->send(['effect_id' => $id]);
        if (!$data) {
            return null;
        }

        return new DogmaEffect($data);
    }
}
