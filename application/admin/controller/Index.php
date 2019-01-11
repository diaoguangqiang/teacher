<?php
/**
 * Created by PhpStorm.
 * User: diaog
 * Date: 2018/12/8
 * Time: 15:00
 */

// 命名空间
namespace app\admin\controller;

use think\Controller;

// 声明控制器
class Index extends Controller{

    // 后台首页方法
    public function index(){
        return view();
    }


}