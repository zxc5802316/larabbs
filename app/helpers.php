<?php
/** .-------------------------------------------------------------------
 * | Created by PhpStorm
 * |-------------------------------------------------------------------
 * |    Author: zxl <1024659300@qq.com>
 * |       Time: 14:55
 * | Copyright (c) 2012-2019, zxl  All Rights Reserved.
 * '-------------------------------------------------------------------*/
function route_class(){
    return str_replace('.',"_",Route::currentRouteName());
}