<?php
/**
 * Yii bootstrap file.
 *
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

require(__DIR__ . '/../vendor/yiisoft/yii2/BaseYii.php');

/**
 * Yii is a helper class serving common framework functionalities.
 *
 * It extends from [[\yii\BaseYii]] which provides the actual implementation.
 * By writing your own Yii class, you can customize some functionalities of [[\yii\BaseYii]].
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Yii extends \yii\BaseYii
{
    /**
     * @var ConsoleApplication|WebApplication|BaseApplication the application instance
     */
    public static $app;
}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = require(__DIR__ . '/../vendor/yiisoft/yii2/classes.php');
Yii::$container = new yii\di\Container();

/**
 * Class BaseApplication
 * Used for properties that are identical for both WebApplication and ConsoleApplication
 *
 */
abstract class BaseApplication extends yii\base\Application
{
}
/**
 * Class WebApplication
 * Include only Web application related components here
 *
 * @property \app\components\esi\EVE $eve EVE Swagger Interface component
 */
class WebApplication extends yii\web\Application
{
}

/**
 * Class ConsoleApplication
 * Include only Console application related components here
 *
 */
class ConsoleApplication extends yii\console\Application
{
}