<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 13.11.18
 * Time: 9:54
 */

namespace app\components\esi\market;

use app\components\esi\EVE;

class Market
{
    public function prices()
    {
        $cacheKey = '/markets/prices/';
        $request = EVE::request('/markets/prices/');
        $request->cacheDuration = 3600;
        $response = $request->send(null, $cacheKey);

        $data = [];
        foreach ($response as $type) {
            $data[$type['type_id']] = $type;
        }

        \Yii::$app->cache->set('markets:prices', $data);
    }

    public function getPrice($typeId)
    {
        $data = \Yii::$app->cache->get('markets:prices');
        if (!$data) {
            $this->prices();
            $data = \Yii::$app->cache->get('markets:prices');
        }

        return isset($data[$typeId]) ? ($data[$typeId]['average_price'] ?? 0) : 0;
    }
}
