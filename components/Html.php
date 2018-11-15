<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 15.11.18
 * Time: 14:41
 */

namespace app\components;

use yii\helpers\ArrayHelper;

class Html extends \yii\helpers\Html
{
    /**
     * Generates an unordered list.
     * @param array|\Traversable $items the items for generating the list. Each item generates a single list item.
     * Note that items will be automatically HTML encoded if `$options['encode']` is not set or true.
     * @param array $options options (name => config) for the radio button list. The following options are supported:
     *
     * - encode: boolean, whether to HTML-encode the items. Defaults to true.
     *   This option is ignored if the `item` option is specified.
     * - separator: string, the HTML code that separates items. Defaults to a simple newline (`"\n"`).
     *   This option is available since version 2.0.7.
     * - itemOptions: array, the HTML attributes for the `li` tags. This option is ignored if the `item` option is specified.
     * - item: callable, a callback that is used to generate each individual list item.
     *   The signature of this callback must be:
     *
     *   ```php
     *   function ($item, $index)
     *   ```
     *
     *   where $index is the array key corresponding to `$item` in `$items`. The callback should return
     *   the whole list item tag.
     *
     * See [[renderTagAttributes()]] for details on how attributes are being rendered.
     *
     * @return string the generated unordered list. An empty list tag will be returned if `$items` is empty.
     */
    public static function ulRecursive($items, $options = [])
    {
        $tag = ArrayHelper::remove($options, 'tag', 'ul');
        $encode = ArrayHelper::remove($options, 'encode', true);
        $formatter = ArrayHelper::remove($options, 'item');
        $separator = ArrayHelper::remove($options, 'separator', "\n");
        $itemOptions = ArrayHelper::remove($options, 'itemOptions', []);

        if (empty($items)) {
            return parent::tag($tag, '', $options);
        }

        $results = [];
        foreach ($items as $index => $item) {
            if ($formatter !== null) {
                $results[] = call_user_func($formatter, $item, $index);
            } else {
                if (is_array($item)) {
                    $content = self::ulRecursive($item);
                } else {
                    $content = $encode ? parent::encode($item) : $item;
                }
                $results[] = parent::tag('li', $content, $itemOptions);
            }
        }

        return parent::tag(
            $tag,
            $separator . implode($separator, $results) . $separator,
            $options
        );
    }
}
