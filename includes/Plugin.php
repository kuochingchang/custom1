<?php

namespace Custom;

class Plugin
{
    /**
     * 启用插件列表
     */
    private static $plugins;

    /**
     * 句柄列表
     */
    private static $handles;

    /**
     * 插件实例化列表
     */
    private static $instances;

    /**
     * 句柄
     */
    private $handle;

    /**
     * 激活组件缓存
     */
    private static $tmp = [];

    /**
     * 插件
     */
    public function __construct($handle)
    {
        $this->handle = $handle;
    }

    /**
     * 插件初始化
     *
     * @param array $plugins 插件列表
     */
    public static function init($plugins)
    {
        self::$plugins = $plugins;
        self::$handles = array_reduce($plugins, function ($carry, $handles) {
            return array_merge_recursive($carry, $handles['handles']);
        }, []);
    }

    /**
     * 导出已启用插件
     */
    public static function export(): array
    {
        return self::$plugins;
    }

    /**
     * 获取实例化插件对象
     *
     * @param string $handle 插件
     */
    public static function factory($handle)
    {
        return self::$instances[$handle] ?? (self::$instances[$handle] = new self($handle));
    }

    /**
     * 激活组件
     */
    public static function activate($pluginName, $pluginConfig)
    {
        self::$plugins[$pluginName]['class_name'] = 'Content\Plugins\\' . $pluginName . '\Plugin';
        self::$plugins[$pluginName]['config'] = $pluginConfig;
        self::$plugins[$pluginName]['handles'] = self::$tmp;
        self::$tmp = [];
    }

    /**
     * 禁用组件
     */
    public static function deactivate($pluginName)
    {
        unset(self::$plugins[$pluginName]);
    }

    /**
     * 插件钩子执行
     */
    public function __call($name, $args)
    {
        $plugin = $this->handle . ':' . $name;
        if (isset(self::$handles[$plugin])) {
            foreach (self::$handles[$plugin] as $callback) {
                call_user_func_array($callback, $args);
            }
        }
    }

    /**
     * 设置属性回调
     */
    public function __set($name, $value)
    {
        $name = $this->handle . ':' . $name;
        if (isset(self::$tmp) && isset(self::$tmp[$name])) {
            array_push(self::$tmp[$name], $value);
        } else {
            self::$tmp[$name] = [$value];
        }
    }
}
