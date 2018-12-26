<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 25.12.18
 * Time: 16:25
 */

namespace app\models\tasks;

class EmailTask extends Task
{
    /**
     * @var array
     */
    public $to;

    /**
     * @var string
     */
    public $from;

    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $body;

    public function to($to)
    {
        $this->to = !is_array($to) ? [$to] : $to;
        return $this;
    }

    public function from($from)
    {
        $this->from = $from;
        return $this;
    }

    public function subject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function body($body)
    {
        $this->body = $body;
        return $this;
    }

    public function getData()
    {
        return [
            'to' => $this->to,
            'from' => $this->from,
            'body' => $this->body,
            'subject' => $this->subject,
        ];
    }

    public function getQueueName()
    {
        return 'email';
    }

    public function process()
    {
        $this->from = $this->from ?? \Yii::$app->params['adminEmail'];
        \Yii::$app->mailer->compose()
            ->setTo($this->to)
            ->setFrom($this->from)
            ->setSubject($this->subject)
            ->setHtmlBody($this->body)
            ->send();

        return true;
    }
}
