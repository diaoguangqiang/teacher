<?php
namespace app\index\controller;

use Sodium\increment;
use think\Db;

use think\Controller;
use think\Request;    // add by dgq 2018.11.7


/**
 * Class Index
 * @package app\index\controller
 *  首页：包括
 *              信息办维修记录：需要密码登录；登录后包括卡务中心维修记录，数据中心维修记录
 *              考研入口
 *              竞赛入口
 *              课程资源，包括练习题库，及教辅平台入口
 *
 */
class Index extends Controller // add by dgq 2018.11.7
{
    public function index()
    {
        // 模板变量赋值
/*		$this->assign('name','ThinkPHP');
		$this->assign('email','thinkphp@qq.com');

		// 或者批量赋值
		$this->assign([
			'name' => 'ThinkPHP',
			'email' => 'thinkphp@qq.com'
		]);
		
		// 模板输出
		//return $this->fetch('index');
		//return "hello sdyu!";
	*/
//		return view();
				
		$data = DB::table('tb_race')->select();
		$this->assign('data', $data);
		return $this->fetch('race');
	}

	public function hello($name)
	{
		return '你好,'.$name;
	}

	public function test(){
        return "测试方法";
    }

    /**
     * 课程方法：打印参数id
     */
    public function course(){
        echo input('id');
    }
    /**
     * 时间方法：打印参数id
     * 设置路由后的 访问形式：http://222.194.77.225/time/2018/12
     */
    public function time(){
        echo input('year').'年'.input('month').'月';
    }

    /**
     * 全动态路由
     */
    public function dongtai(){
        echo input('a')." ".input('b');
    }

    /**
     * 完全匹配路由
     */
    public function wanquan(){
        echo "测试方法";
    }

    /**
     * 带额外参数
     */
    public function param(){
        dump(input());
        echo "测试方法";
    }

    /**
     * 请求类型
     */
    public function login(){
        // 打印提交的数据
        dump(input());

        echo "测试提交类型";
        return view("type");
    }

    /**
     * 页面跳转，统计 点击量
     */
    public function race_jump(){
        //dump(input());

        $id = input('id');
        $site = input('site');

        if(empty($site) || empty($id)){
            echo "<script>alert('跳转失败，原因:入参为空!');history.go(-2)</script>";
        }

        // 保存访客的ip
        $req = Request::instance();
        //dump($req);
        // 如果是白名单，不入库
        if(!$this->check_white_ip($req->ip())){
            $this->save_visit_ip($req->url());
            // step1 写数据库 ++1
            DB::table("tb_race")->where('id', $id)->setInc('hits');
        }

        // step3 跳转 site
        $this->redirect_site($site);
    }

    /**
     * 跳转到指定地址
     */
    private function redirect_site($_web_site){
        $this->redirect($_web_site);
    }

    /**
     * @return int|string
     * save the current user's ip
     */
    private function save_visit_ip($_type){
        $request = Request::instance();
        $ip = $request->ip();

        //当前网络状态不佳，请稍后再试，或刷新页面解决
        $url = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$ip;
        $result = file_get_contents($url);
        $result = json_decode($result, true);
        $region = $result['data']['region'];
        $city = $result['data']['city'];
        $isp = $result['data']['isp'];
        $cur_time = date('Y-m-d H:i:s');

        $data['ip']=$ip;
        $data['region']=$region;
        $data['city']=$city;
        $data['isp']=$isp;
        $data['type']=$_type;
        $data['time']=$cur_time;

        //dump($data);
        //dump($cur_time);
        //dump($city);
        //dump($result);

        // 插入数据，并，返回id
        $ins_id = DB::table("tb_visit_ip")->insertGetId($data);
        //dump($ins_id);
        return $ins_id;
    }

    /**
     * 检测是否白名单，如果是，不记录数据库
     * 10.191.16.19: 南京依迅的情报分析系统
     */
    private function check_white_ip($_ip){
        if($_ip == "10.191.16.19"){
            return true; // 不入库
        }else{
            return false; // 入库
        }
    }
}
