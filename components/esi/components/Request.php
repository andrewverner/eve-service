<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 10.10.18
 * Time: 9:00
 */

namespace app\components\esi\components;

use app\components\logger\Logger;

class Request
{
    const TYPE_GET = 'GET';
    const TYPE_PUT = 'PUT';
    const TYPE_POST = 'POST';
    const TYPE_DELETE = 'DELETE';

    protected $uri;
    protected $headers;
    protected $body;
    protected $query = [];
    public $cacheDuration = 900;

    public $error;
    protected $type;

    public function __construct($uri, $type = false)
    {
        $this->uri = $uri;
        $this->type = $type ?: self::TYPE_GET;
    }

    public function headers($headers)
    {
        $this->headers = $headers;
        return $this;
    }

    public function body($data)
    {
        $this->body = $data;
        return $this;
    }

    public function query(array $query)
    {
        $this->query = $query;
        return $this;
    }

    public function send(array $params = null, $cacheKey = null, $force = null)
    {
        if ($cacheKey && !$force) {
            if (\Yii::$app->cache->exists($cacheKey)) {
                return unserialize(\Yii::$app->cache->get($cacheKey));
            }
        }

        $this->uri = parse_url($this->uri, PHP_URL_SCHEME)
            ? $this->uri
            : "https://esi.evetech.net/latest{$this->uri}";

        if (!empty($this->query)) {
            $this->uri .= '?' . http_build_query($this->query);
        }

        if ($params && !empty($params)) {
            foreach ($params as $key => $val) {
                $this->uri = str_replace("{{$key}}", $val, $this->uri);
            }
        }

        if (YII_DEBUG) {
            Logger::log("Sending request: {$this->uri}", 'request');
        }

        $ch = curl_init($this->uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            $this->type == self::TYPE_POST ? CURLOPT_POST : CURLOPT_CUSTOMREQUEST,
            $this->type == $this::TYPE_POST ? true : $this->type
        );
        if ($this->body) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->body);
        }
        if ($this->headers) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        }
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            $errno = curl_errno($ch);
            $error = curl_error($ch);
            $this->error = "cURL error #{$errno}: {$error}";
            Logger::log("Error: {$this->error}", 'request');
            curl_close($ch);

            return false;
        }

        curl_close($ch);

        $data = json_decode($result, true);
        if (isset($data['error'])) {
            $this->error = $data['error'];
            Logger::log("Error: {$this->error}", 'request');

            return false;
        }
        if ($cacheKey && $data) {
            \Yii::$app->cache->set($cacheKey, serialize($data), $this->cacheDuration);
        }

        return $data;
    }
}
