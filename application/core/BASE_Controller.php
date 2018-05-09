<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BASE_Controller extends CI_Controller {

    protected static $_loginUserInfo = [];

    public function __construct(){
        parent::__construct();

        // 执行父类构造函数 不用也可
        self::$_loginUserInfo = $this -> session -> userdata('loginUser');
        if (empty(self::$_loginUserInfo)) {
            redirect('login','location');
        }
        // 判断session是否过期来判断是否登录 未登录跳转到登录页
    }

}
