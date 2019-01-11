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

class Dx extends Controller // add by dgq 2018.11.7
{
    public function index()
    {
        $map['major']='电子信息工程';
        $map['grade']='2014';
        $data = DB::table('v_graduate')
            ->field('id,student_no,student_name,NAME,hits')
            ->where($map)->select();
        $this->assign('data', $data);
        //dump($data);
        return $this->fetch("graduate/dx");
    }

}