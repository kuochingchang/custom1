<?php

namespace Custom;

class Request
{
    /**
     * 单例实例
     */
    private static $instance;

    /**
     * 请求 url
     */
    private $requestUri;

    /**
     * 路径信息
     */
    private $pathinfo;

    /**
     * 请求前缀
     */
    private $urlPrefix;

    /**
     * 请求根
     */
    private $requestRoot;

    /**
     * 请求入口文件
     */
    private $requestIndex;

    /**
     * 获取请求 url
     */
    public function getRequestUri()
    {
        if (empty($this->requestUri)) {
            $this->requestUri = $_SERVER['REQUEST_URI'];
        }

        return $this->requestUri;
    }

    /**
     * 获取处理 pathinfo
     */
    public function getPathInfo()
    {
        if (empty($this->pathinfo)) {
            $pathinfo = $this->getRequestUri();

            // 删除查询字符串
            if ($pos = strpos($pathinfo, '?')) {
                $pathinfo = substr($pathinfo, 0, $pos);
            }

            // 删除 index.php
            if ($pos = strpos($pathinfo, '.php')) {
                $pathinfo = rtrim(substr($pathinfo, $pos + 4), '/') . '/';
            }

            $this->pathinfo = $pathinfo;
        }

        return $this->pathinfo;
    }

    /**
     * 获取请求前缀
     */
    public function getUrlPrefix()
    {
        if (empty($this->urlPrefix)) {
            $this->urlPrefix = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
        }

        return $this->urlPrefix;
    }

    /**
     * 获取参数
     *
     * @param string $key 键
     */
    public function get($key, $default = null)
    {
        return $this->params[$key] ?? $_GET[$key] ?? $_POST[$key] ?? $default;
    }

    /**
     * 获取参数
     *
     * @param string $key 键
     */
    public function getPost($key = null)
    {
        if ($key) {
            return $_POST[$key] ?? '';
        } else {
            return $_POST ? $_POST : [];
        }
    }

    /**
     * 判断查询参数是否满足实际参数
     *
     * @param mixed $query 条件
     */
    public function is($query)
    {
        $validated = false;

        if (is_string($query)) {
            parse_str($query, $params);
        } elseif (is_array($query)) {
            $params = $query;
        }

        foreach ($params as $key => $value) {
            $param = $this->get($key);
            $validated = !empty($param) || $param === $value;

            if ($validated) {
                break;
            }
        }

        return $validated;
    }

    /**
     * 获取参数
     */
    public function __get($name)
    {
        return $this->get($name);
    }

    /**
     * 获取单例实例
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
