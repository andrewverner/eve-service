<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 25.12.18
 * Time: 16:25
 */

namespace app\models\tasks;

class EmailTask
{
    /**
     * @var array
     */
    private $to;

    /**
     * @var string
     */
    private $from;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $body;

    /**
     * EmailTask constructor.
     * @param string|array $to
     * @param string $subject
     * @param string $body
     * @param string $from
     */
    public function __construct($to, $subject, $body, $from = null)
    {
        $this->to = !is_array($to) ? [$to] : $to;
        $this->subject = $subject;
        $this->body = $body;
        $this->from = $from ?? \Yii::$app->params['adminEmail'];
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
}
