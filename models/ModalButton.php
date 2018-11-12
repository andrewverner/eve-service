<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.11.2018
 * Time: 22:51
 */

namespace app\models;

/**
 * Class ModalButton
 * @package app\models
 */
class ModalButton
{
    public $id;
    public $class;
    public $title;
    public $closeModal;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function closeModal($close)
    {
        $this->closeModal = $close;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        $options = [];
        if ($this->id) {
            $options[] = "id=\"{$this->id}\"";
        }
        if ($this->class) {
            $options[] = "class=\"{$this->class}\"";
        }
        if ($this->closeModal) {
            $options[] = "data-dismiss=\"modal\"";
        }

        return $options;
    }
}
