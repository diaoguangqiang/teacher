<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 引用route系统类
use think\Route;

/************** 前台路由规则 ***************/
// 1. 静态路由规则
// Route::rule('路由表达式', '路由地址'，‘请求类型’，‘路由参数（数组）’,变量规则(数组))
//Route::rule('/', 'index/index/index' );
// http://222.194.77.225/test 等同于 http://222.194.77.225/index.php/index/test
// 如果定义过test路由，则 http://222.194.77.225/index.php/index/test失效, 既PATH_INFO规则失效
Route::rule('test','index/index/test');

// 2. 带参数的路由：
// 给课程传参数 id, 访问形式： http://222.194.77.225/course/1/
// 等同于  http://222.194.77.225/index.php/index/test/1, 但是定义路由之后，此路径失效
//Route::rule('course/:id', 'index/index/course');
// 带参路由：http://222.194.77.225/time/2018/12
Route::rule('time/:year/:month', 'index/index/time');

// 3.可选参数路由, month可带可不带， 形式：http://222.194.77.225/time/2018/
Route::rule('time/:year/[:month]', 'index/index/time');

// 4. 全动态路由(禁用)
// 容易冲突，与之前的路由规则，容易匹配, 所以基本不用全动态路由。
//Route::rule(':a/:b', 'index/index/dongtai');

// 5. 完全匹配路由
// 形式：http://222.194.77.225/test1/xxx/xxx/xxx/xxx 均可
Route::rule('test1', 'index/index/wanquan');
// 完全路由添加结束符 $, 形式：http://222.194.77.225/test2/xxx 报错
Route::rule('test2$', 'index/index/wanquan');

// 6. 带额外参数
// 形式：http://222.194.77.225/test3/
Route::rule('test3','index/index/param?id=1&p=100');

/************************************/
// Route::rule('路由表达式', '路由地址'，‘请求类型’，‘路由参数（数组）’,变量规则(数组))
// 7. 请求类型, 经过测试 post未生效
// 限定提交的类型 只能get请求, 下面两种方式效果一样
//Route::rule('type1','index/index/type', 'get');
//Route::get('type','index/index/type');
// 限定支持post
//Route::rule('type2','index/index/type', 'post');
//Route::get('login','index/index/login');
//同时支持get 和 post
//Route::rule('login','index/index/login', 'get|post');
// 支持所有请求类型
//Route::rule('type','index/index/type', '*');
//Route::any('type','index/index/type');

// 8 批量注册路由
Route::rule([
   "/"=>"index/index/index",
   //"course/:id"=>"index/index/course",
   // "login"=>"index/index/login"
    "race_jump"=>"index/index/race_jump",
    //"graduate"=>"index/Graduate/index",
    //"g"=>"index/Graduate/index",
    "dx"=>"index/Graduate/dx",
    "jk"=>"index/Graduate/jk",
    "xg"=>"index/Graduate/xg",
    "info"=>"index/Graduate/info",
    "qq"=>"index/Graduate/qq",
    "eyy"=>"index/Graduate/eyy",
    "jbw"=>"index/Graduate/jbw",
]);

Route::get([
    //"course/:id"=>"index/index/course"
]);

Route::post([
    //"login"=>"index/index/login"
]);

/*return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
*/