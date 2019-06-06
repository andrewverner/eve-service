<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 26.12.18
 * Time: 9:08
 */

namespace app\components\logger;

class Logger
{
    const LEVEL_NOTICE = 'NOTICE';
    const LEVEL_WARNING = 'WARNING';
    const LEVEL_ERROR = 'ERROR';
    const LEVEL_FATAL = 'FATAL';

    public static function log($message, $category, $level = self::LEVEL_NOTICE)
    {
        if (YII_DEBUG) {
            $date = (new \DateTime())->format('Y-m-d H:i:s');
            $message = "[$level] {$date}: {$message}" . PHP_EOL;
            file_put_contents(\Yii::getAlias('@runtime') . "/logs/{$category}.log", $message, FILE_APPEND);
        }
    }
}
