<?php
namespace app\index\controller;

use think\Db;
use think\facade\Session;
use think\Request;

class User
{

    public function __construct() {
        ini_set('session.save_path', '/tmp');
    }

    public function index()
    {
        return 111;
    }

    /**
     * 注册
     * @param Request $request
     * @return false|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function signup(Request $request)
    {
        $username = trim($request->post('username'));
        $password = trim($request->post('password'));

        if (empty($username) || empty($password)){
            return json_encode([
                'code' => 201,
                'msg' => '账号或者密码为空',
            ]);
        }

        #todo 正则校验
        $res = Db::table('user')->where(['username' => $username, 'password' => $password])->find();

        if($res){
            return json_encode([
                'code' => 201,
                'msg' => '该账号已经注册',
            ]);
        }

        $res = Db::name('user')
            ->data(['username' => $username, 'password' => $password])
            ->insert();

        return json_encode([
            'code' => 200,
            'msg' => '成功',
        ]);
    }

    /**
     * 登录
     * @param Request $request
     * @return false|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function login(Request $request)
    {
        $username = trim($request->post('username'));
        $password = trim($request->post('password'));

        $res = Db::table('user')->where(['username' => $username, 'password' => $password])->find();
        if(Session::get($username)){
            return json_encode([
                'code' => 200,
                'msg' => '成功',
            ]);
        }
        if($res){
//            setcookie('user','mzz',time()+3600*24*7);
            Session::set($username,'1');
            return json_encode([
                'code' => 200,
                'msg' => '成功',
            ]);
        }else{
            return json_encode([
                'code' => 201,
                'msg' => '账号或者密码错误',
            ]);
        }
    }


    public function loginout(Request $request)
    {
        $username = trim($request->post('username'));
        $password = trim($request->post('password'));

        $res = Db::table('user')->where(['username' => $username, 'password' => $password])->find();

        if($res){
            return json_encode([
                'code' => 200,
                'msg' => '成功',
            ]);
        }else{
            return json_encode([
                'code' => 201,
                'msg' => '账号或者密码错误',
            ]);
        }
    }
//
//    public function test()
//    {
//        ini_set('session.save_path', '/tmp');
//        Session::set('name','sss');
//        print_r(Session::get('name'));
//    }
}
