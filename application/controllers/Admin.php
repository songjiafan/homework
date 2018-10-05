<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends BASE_Controller {

    public function __construct(){
        parent::__construct();
        // 执行父类构造函数 保证登录拦截
        $this -> load -> model('operation_model');
        // 默认加载model类 减少冗余代码量
    }

    public function user () {
        $list = $this -> operation_model -> get_user(); // 获取全部用户
        $renderData = [
            'admin' => self::$_loginUserInfo -> is_admin,
            'role' => self::$_loginUserInfo -> role,
            'username' => self::$_loginUserInfo -> username,
            'list' => $list,
        ];
        $this -> load -> view('user', $renderData);  // 渲染页面
    }

    public function add () {
        $uid = $this -> input -> post('uid');
        $checkRes = $this -> operation_model -> get_user_by_uid($uid); // 查询是否存在这个学号
        if ($checkRes) {
            $this -> showResult(1, '新增失败 学号重复'); // 如果存在 返回失败
            return false;
        }
        $username = $this -> input -> post('username');
        $class = $this -> input -> post('class');
        $enterTime = $this -> input -> post('enter_time');
        $role = $this -> input -> post('role');
        $postData = [
            'uid' => $uid,
            'username' => $username,
            'class' => $class,
            'enter_time' => $enterTime,
            'role' => $role
        ];
        $res = $this -> operation_model -> add_user($postData); // 调用数据库方法 insert一条数据
        if ($res) {
            $this -> showResult(0, '新增用户成功');
        } else {
            $this -> showResult(1, '新增失败 内部错误');
        }

    }

    public function del () {
        $id = $this -> input -> post('id');
        $res = $this -> operation_model -> del_user($id); // 调用删除用户方法

        if ($res) {
            $this -> showResult(0, '删除用户成功');
        } else {
            $this -> showResult(1, '删除失败 内部错误');
        } // 返回结果
    }

    public function del_file () {
        $id = $this -> input -> get('id');
        $res = $this -> operation_model -> del_file($id);
        if ($res) {
            redirect('welcome'); // 成功之后重定向到首页 减少代码量
        } else {
            echo '删除失败 内部错误';
        }
    }
}
