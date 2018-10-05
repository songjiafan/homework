<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome extends BASE_Controller {

    public function __construct(){
        parent::__construct();
        // 执行父类构造函数 保证登录拦截
        $this -> load -> model('login_model');
        $this -> load -> model('question_model');
        // 默认加载model类 减少冗余代码量
    }

    public function index () {
        $where = ['del' => 0];
        $list1 = $this -> question_model -> get_question($where);
        $list2 = $this -> question_model -> get_offline_question($where);
        $fileList = $this -> login_model -> get_file();
        foreach ($fileList as $item) {
            $name = $this -> login_model -> check_exist($item->own_id);
            $item -> username = $name[0] -> username;
        } // 遍历查询出所有用户名
        $renderData = [
            'admin' => self::$_loginUserInfo -> is_admin,
            'role' => self::$_loginUserInfo -> role,
            'username' => self::$_loginUserInfo -> username,
            'list' => array_merge($list1, $list2),
            'fileList' => $fileList
        ];
        $this -> load -> view('index', $renderData);
        // 渲染页面 带三个参数 是否管理员
    }
}
