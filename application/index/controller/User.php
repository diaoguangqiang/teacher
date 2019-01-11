<?php
/**
 * Created by PhpStorm.
 * User: diaog
 * Date: 2018/12/13
 * Time: 15:59
 */

 namespace  app\index\controller;

 use think\Controller;


 class User extends Controller
{
    public function index(){
        return $this->fetch("user");

        //return view();
    }

    public function check(){
        return view();
    }


}