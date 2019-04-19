<?php
/** .-------------------------------------------------------------------
 * | Created by PhpStorm
 * |-------------------------------------------------------------------
 * |    Author: zxl <1024659300@qq.com>
 * |       Time: 17:37
 * | Copyright (c) 2012-2019, zxl  All Rights Reserved.
 * '-------------------------------------------------------------------*/
use  App\Models\Tag;

return [
    // 页面标题
    'title'   => '标签',

    // 模型单数，用作页面『新建 $single』
    'single'  => '标签',

    // 数据模型，用作数据的 CRUD
    'model'   => Tag::class,

    // 设置当前页面的访问权限，通过返回布尔值来控制权限。
    // 返回 True 即通过权限验证，False 则无权访问并从 Menu 中隐藏
    'permission'=> function()
    {
        return Auth::user()->can('manage_users');
    },

    // 字段负责渲染『数据表格』，由无数的『列』组成，
    'columns' => [

        // 列的标示，这是一个最小化『列』信息配置的例子，读取的是模型里对应
        // 的属性的值，如 $model->id
        'id',
        'name' => [
            'title'    => '标签名称',
        ],

        'topic_count' => [
            'title' => '标签话题数量',
        ],

        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],

    // 『模型表单』设置项
    'edit_fields' => [
        'name' => [
            'title' => '标签名称',
        ],
    ],

    // 『数据过滤』设置
    'filters' => [
        'name' => [
            'title' => '标签名称',
        ],
    ],
];