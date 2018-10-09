<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 09.10.18
 * Time: 12:10
 */

namespace app\components\esi\components;

use app\components\esi\exceptions\WrongRequestTypeException;

class EVERequest
{
    const TYPE_GET    = 'GET';
    const TYPE_PUT    = 'PUT';
    const TYPE_POST   = 'POST';
    const TYPE_DELETE = 'DELETE';

    private $type = self::TYPE_GET;
    private $uri;
    private $query;
    private $body;
    private $headers;

    private $error;

    public function __construct($uri, $type = null)
    {
        $this->uri = $uri;
        if ($type) {
            $this->type($type);
        }
    }

    public function type($type)
    {
        if (!in_array($type, [
            self::TYPE_GET,
            self::TYPE_PUT,
            self::TYPE_POST,
            self::TYPE_DELETE,
        ])) {
            throw new WrongRequestTypeException();
        }

        $this->type = $type;
    }

    public function get()
    {
        $this->type = self::TYPE_GET;
        return $this;
    }

    public function put()
    {
        $this->type = self::TYPE_PUT;
        return $this;
    }

    public function post()
    {
        $this->type = self::TYPE_POST;
        return $this;
    }

    public function delete()
    {
        $this->type = self::TYPE_DELETE;
        return $this;
    }

    public function query(array $params)
    {
        $this->query = $params;
        return $this;
    }

    public function body($body)
    {
        $this->body = $body;
        return $this;
    }

    public function headers(array $headers)
    {
        $this->headers = $headers;
        return $this;
    }

    public function send()
    {
        $url = parse_url($this->uri, PHP_URL_SCHEME)
            ? $this->uri
            : "https://esi.evetech.net/latest{$this->uri}";

        if ($this->query) {
            $this->uri .= '?' . http_build_query($this->query);
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            $this->type == self::TYPE_POST ? CURLOPT_POST : CURLOPT_CUSTOMREQUEST,
            $this->type == $this::TYPE_POST ? true : $this->type
        );
        if ($this->body) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data);
        }
        if ($this->headers) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
        }
        $result = curl_exec($ch);
        curl_close($ch);

        if (curl_errno($ch)) {
            $errno = curl_errno($ch);
            $error = curl_error($ch);
            $this->error = "CUrl error #{$errno}: {$error}";
            return false;
        }

        $data = json_decode($result, true);
        if (isset($data['error'])) {
            $this->error = $data['error'];
            return false;
        }

        return $data;
    }
}
