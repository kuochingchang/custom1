<?php

namespace Custom\Widget\Base;

use Custom\Medoo\Exception;
use Custom\Medoo\Medoo;
use Custom\Widget;

/**
 * 数据抽象组件
 */
abstract class Base extends Widget
{
    /**
     * 数据库对象
     */
    protected $db;

    protected function init()
    {
        try {
            // 初始化数据库对象
            $this->db = new Medoo(DB_CONFIG);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
