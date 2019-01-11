<?php
/**
 * Created by PhpStorm.
 * User: diaog
 * Date: 2018/12/17
 * Time: 21:33
 */

namespace app\index\controller;

use Sodium\increment;
use think\Db;

use think\Controller;

class Graduate extends Controller{
    public function index(){
        $school = DB::table('v_graduate')
            ->field('NAME, web_site,count(NAME) as counts')
            ->group('NAME')
            ->order('counts desc, NAME asc')
            ->limit(0,10)
            ->select();
        $this->assign('school', $school);
        //dump($school);

        $city = DB::table('v_graduate')
            ->field('province, count(province) as counts')
            ->group('province')
            ->order('counts desc')
            ->limit(0,10)
            ->select();
        $this->assign('city', $city);

        return $this->fetch('index');
    }

    /**
     * 211
     */
    public function eyy(){
        return $this->fetch("graduate/211");
    }

    /**
     * 985
     */
    public function jbw(){
        return $this->fetch("graduate/985");
    }

    public function dx(){
        $map['major']='电子信息工程';
        $group = DB::table('v_graduate')
            ->field('min(grade) as min, max(grade) as max')
            ->where($map)
            ->select();
        //dump($group);
        $this->assign('min', $group['0']['min']);
        $this->assign('max', $group['0']['max']);
        //dump($group['0']['min'].'~'.$group['0']['max']);

        $count = DB::table('v_graduate')
            ->field('count(1) as count')
            ->where($map)
            ->select();
        $this->assign('count', $count['0']['count']);
        //dump($count);

        $data = DB::table('v_graduate')
            ->field('id,grade,student_no,student_name,NAME,hits')
            ->where($map)->select();
        $this->assign('data', $data);
        //dump($data);
        return $this->fetch("graduate/dx");
    }

    public function jk(){
        $map['major']='计算机科学与技术';
        $group = DB::table('v_graduate')
            ->field('min(grade) as min, max(grade) as max')
            ->where($map)
            ->select();
        //dump($group);
        $this->assign('min', $group['0']['min']);
        $this->assign('max', $group['0']['max']);
        //dump($group['0']['min'].'~'.$group['0']['max']);

        $count = DB::table('v_graduate')
            ->field('count(1) as count')
            ->where($map)
            ->select();
        $this->assign('count', $count['0']['count']);
        //dump($count);

        $data = DB::table('v_graduate')
            ->field('id,grade,student_no,student_name,NAME,hits')
            ->where($map)
            ->order('grade desc')
            ->select();
        $this->assign('data', $data);
        //dump($data);

        return $this->fetch("graduate/jk");
    }

    public function xg(){
        $map['major']='信息管理与信息系统';
        $group = DB::table('v_graduate')
            ->field('min(grade) as min, max(grade) as max')
            ->where($map)
            ->select();
        //dump($group);
        $this->assign('min', $group['0']['min']);
        $this->assign('max', $group['0']['max']);
        //dump($group['0']['min'].'~'.$group['0']['max']);

        $count = DB::table('v_graduate')
            ->field('count(1) as count')
            ->where($map)
            ->select();
        $this->assign('count', $count['0']['count']);
        //dump($count);

        $data = DB::table('v_graduate')
            ->field('id,grade,student_no,student_name,NAME,hits')
            ->where($map)
            ->order('grade desc')
            ->select();
        $this->assign('data', $data);
        //dump($data);

        return $this->fetch("graduate/xg");
    }

    public function info(){
        $student_no = input('id');
        //dump($student_no);
        if(empty($student_no)){
            echo "<script>alert('跳转失败，原因:入参为空!');history.go(-2)</script>";
        }

        //dump($student_no);
        // step1 写数据库 ++1
        $ret = DB::table("tb_graduate")->where('no', $student_no)->setInc('hits');
        //dump($ret);

        $map['student_no']=$student_no;
        $data = DB::table('v_graduate')
            ->where($map)->select();
        $this->assign('data', $data);
        $this->assign('title', $data['0']['major']);
        //dump($data);

        return $this->fetch("graduate/info");
    }

    /**
     *
     */
    public function qq(){
        return $this->fetch("graduate/qq");
    }
}