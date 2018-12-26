<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 26.12.18
 * Time: 7:57
 */

namespace app\models\tasks;

abstract class Task
{
    public $id;

    abstract public function getData();

    abstract public function getQueueName();

    abstract public function process();

    public function populate(array $data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
