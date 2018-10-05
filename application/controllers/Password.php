<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Password extends BASE_Controller {

    public function __construct(){
        parent::__construct();
        // 执行父类构造函数 保证登录拦截
        $this -> load -> model('password_model');
        // 默认加载model类 减少冗余代码量
    }

    public function index () {

        $renderData = [
            'admin' => self::$_loginUserInfo -> is_admin,
            'role' => self::$_loginUserInfo -> role,
            'username' => self::$_loginUserInfo -> username,
        ];
        $this -> load -> view('password', $renderData);
        // 渲染 带一个是否管理员参数
    }

    public function check () {
        $pwd = $this -> input -> post('password');
        $postData = [
            'password' => $pwd,
            'uid' => self::$_loginUserInfo -> uid,
        ];
        $res = $this -> password_model -> check_pwd($postData);
        if ($res) {
            $this -> showResult(0, '密码正确');
        } else {
            $this -> showResult(1, '当前密码错误');
        }
    }

    public function change () {
        $newPwd = $this -> input -> post('new_password');
        $uid = self::$_loginUserInfo -> uid;
        $res = $this -> password_model -> change_pwd(['password' => $newPwd], $uid);
        if ($res) {
            $this -> showResult(0, '修改成功');
        } else {
            $this -> showResult(1, '修改失败 内部错误');
        }
    }
}
