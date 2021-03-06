<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');

// 绑定后台 dgq 20181208
define('BIND_MODULE', 'admin');

// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';

// 路由的作用：百度搜索，后台文件不需要百度搜索，所以通过：关闭后台路由 dgq 20181208
// 这句话在写 加载框架引导文件 之后，否则出错
// 路由只针对应用，不针对模块
\think\App::route(false);