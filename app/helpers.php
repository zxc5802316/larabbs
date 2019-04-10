<?php
/** .-------------------------------------------------------------------
 * | Created by PhpStorm
 * |-------------------------------------------------------------------
 * |    Author: zxl <1024659300@qq.com>
 * |       Time: 14:55
 * | Copyright (c) 2012-2019, zxl  All Rights Reserved.
 * '-------------------------------------------------------------------*/
function route_class(){
    return str_replace('.',"-",Route::currentRouteName());
}
function categroy_nav_active ($categroy_id){
    return active_class((if_route("categories.show")) && (if_route_param("category",$categroy_id)));
}
function make_excerpt($value,$length = 200){
    $excerpt = trim(preg_replace('/\r\n\|r\|\n+/',"",strip_tags($value)));
    return str_limit($excerpt,$length);
}