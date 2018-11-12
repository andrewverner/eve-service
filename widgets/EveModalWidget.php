<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.11.2018
 * Time: 22:48
 */

namespace app\widgets;

use yii\base\Widget;

class EveModalWidget extends Widget
{
    public $title;
    public $id;
    public $buttons = [];

    public function init()
    {
        parent::init();
        ob_start();
    }

    public function run()
    {
        $content = ob_get_clean();

        return $this->render('eve-modal', [
            'title' => $this->title,
            'content' => $content,
            'id' => $this->id ?: 'eve-modal-' . time(),
            'buttons' => $this->buttons,
        ]);
    }
}
