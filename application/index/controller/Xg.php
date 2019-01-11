<?php
/**
 * Created by PhpStorm.
 * User: diaog
 * Date: 2018/12/18
 * Time: 14:03
 */

namespace app\index\controller;

use Sodium\increment;
use think\Db;

use think\Controller;
use think\Request;    // add by dgq 2018.11.7

class Xg extends Controller // add by dgq 2018.11.7
{
    /*
    public function index()
    {
        $map['major']='信息管理与信息系统';
        $map['grade']='2014';
        $data = DB::table('v_graduate')
            ->field('id,student_name,NAME,hits')
            ->where($map)->select();
        $this->assign('data', $data);
        //dump($data);
        return $this->fetch("graduate/xg");
    }
    */
}