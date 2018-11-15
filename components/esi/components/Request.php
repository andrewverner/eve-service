<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 10.10.18
 * Time: 9:00
 */

namespace app\components\esi\components;

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

    public function send(array $params = null, string $cacheKey = null, bool $force = false)
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

        file_put_contents('/var/www/html/eve/request.log', (new \DateTime())->format('Y-m-d H:i:s') . ": Sending request: {$this->uri}" . PHP_EOL, FILE_APPEND);

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
            curl_close($ch);
            $errno = curl_errno($ch);
            $error = curl_error($ch);
            $this->$error = "cURL error #{$errno}: {$error}";
            file_put_contents('/var/www/html/eve/request.log', "Error: {$this->error}" . PHP_EOL, FILE_APPEND);

            return false;
        }

        curl_close($ch);

        $data = json_decode($result, true);
        if (isset($data['error'])) {
            $this->error = $data['error'];
            file_put_contents('/var/www/html/eve/request.log', "Error: {$this->error}" . PHP_EOL, FILE_APPEND);

            return false;
        }
        if ($cacheKey) {
            \Yii::$app->cache->set($cacheKey, serialize($data), $this->cacheDuration);
        }

        return $data;
    }
}
