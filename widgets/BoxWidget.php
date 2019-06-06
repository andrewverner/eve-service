<?php

namespace app\widgets;

use yii\base\Widget;

class BoxWidget extends Widget
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var array
     */
    public $buttons = [];

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        ob_start();
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $content = ob_get_clean();
        return $this->render('box', [
            'content' => $content,
            'buttons' => $this->buttons,
            'title' => $this->title,
        ]);
    }

    /**
     * @param string $html
     */
    public function addButton($html)
    {
        $this->buttons[] = $html;
    }
}