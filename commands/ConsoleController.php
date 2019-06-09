<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 24.12.18
 * Time: 12:23
 */

namespace app\commands;

use yii\console\Controller;
use yii\helpers\Console;

class ConsoleController extends Controller
{
    public function log($string)
    {
        $this->stdout($string . PHP_EOL, Console::FG_GREY);
    }

    public function logSuccess($string)
    {
        $this->stdout($string . PHP_EOL, Console::FG_GREEN);
    }

    public function logInfo($string)
    {
        $this->stdout($string . PHP_EOL, Console::FG_CYAN);
    }

    public function logWarning($string)
    {
        $this->stdout($string . PHP_EOL, Console::FG_YELLOW);
    }

    public function logError($string)
    {
        $this->stdout($string . PHP_EOL, Console::FG_RED);
    }

    public function actionColors()
    {
        for ($i=1; $i<=50; $i++) {
            $this->stdout($i . PHP_EOL, $i);
        }
    }
}
