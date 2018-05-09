<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome extends BASE_Controller {

    public function __construct(){
        parent::__construct();
        // 执行父类构造函数 保证登录拦截
        $this -> load -> model('login_model');
        // 默认加载model类 减少冗余代码量
    }

    public function index () {
        $this -> load -> view('index', array('admin' => self::$_loginUserInfo -> role == 1));
        // 渲染 带一个是否管理员参数
    }
}
