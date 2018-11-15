<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.11.2018
 * Time: 14:41
 */

namespace app\widgets;

use yii\base\Widget;

class EvePanelWidget extends Widget
{
    public $title;

    public function init()
    {
        parent::init();
        ob_start();
    }

    public function run()
    {
        $content = ob_get_clean();

        return $this->render('eve-panel', [
            'title' => $this->title,
            'content' => $content,
        ]);
    }
}
