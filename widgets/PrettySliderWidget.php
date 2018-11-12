<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 03.11.2018
 * Time: 12:39
 */

namespace app\widgets;

use yii\base\Widget;

class PrettySliderWidget extends Widget
{
    public $name;
    public $title;
    public $checked;
    public $options;

    public function run()
    {
        return $this->render('pretty-slider', [
            'name' => $this->name,
            'title' => $this->title,
            'checked' => $this->checked,
            'options' => $this->options,
        ]);
    }
}
