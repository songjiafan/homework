<?php

class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();
        // 执行父类构造函数 保证登录拦截
        $this -> load -> model('login_model');
        // 默认加载model类 减少冗余代码量
    }

    public function index(){
        $this -> load -> view('login');
    }

    public function do_login(){
        $userId = $this -> input -> post('user_id');
        $passWord = $this -> input -> post('password');
        // 获取前端的post参数

        $resExist = $this -> login_model -> check_exist($userId);
        if (empty($resExist)) {
            $this -> showResult(1, '用户名不存在 请联系管理员');
        }
        //判断uid是否存在

        $resCheck = $this -> login_model -> check_password($userId, $passWord);
        if (empty($resCheck)) {
            $this -> showResult(2, '密码错误 请重新登录');
        }
        //判断密码是否正确
        $this -> session -> set_userdata('loginUser', $resCheck[0]);
        $this -> showResult(0, '登录成功');
        //登录成功 记录session
    }

    public function logout(){
        $this -> session -> unset_userdata('loginUser');
        redirect('login');
    }
}
