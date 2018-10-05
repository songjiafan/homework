<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Forum extends BASE_Controller {

    public function __construct(){
        parent::__construct();
        // 执行父类构造函数 保证登录拦截
        $this -> load -> model('forum_model');
        // 默认加载model类 减少冗余代码量
    }

    public function index () {
        $this -> load -> model('login_model');
        $list = $this -> forum_model -> get_list();
        foreach ($list as $k => $v) {
            $name = $this -> login_model -> check_exist($v->uid);
            $v -> name = $name[0] -> username;
            if ($v->pid) {
                $reply_name = $this -> login_model -> check_exist($v->pid);
                $v -> reply_name = $reply_name[0] -> username; // 回复人中文名
            }
        }
        $renderData = [
            'admin' => self::$_loginUserInfo -> is_admin,
            'role' => self::$_loginUserInfo -> role,
            'username' => self::$_loginUserInfo -> username,
            'list' => $list
        ];
        $this -> load -> view('forum', $renderData);
        // 渲染 带一个是否管理员参数
    }


    public function reply () {
        $pid = $this -> input -> post('id');  // 获取传送的id参数
        $content = $this -> input -> post('content');  // 获取传送的content参数
        $uid = self::$_loginUserInfo -> uid;
        $postData = [
            'pid' => $pid,
            'content' => $content,
            'uid' => $uid
        ];
        $res = $this -> forum_model -> reply($postData); // 调用model方法 添加线下题
        if ($res) {
            $this -> showResult(0, '新增评论成功');
        } else {
            $this -> showResult(1, '评论失败 内部错误');
        }
    }

    public function add () {
        $content = $this -> input -> post('content');  // 获取传送的content参数
        $uid = self::$_loginUserInfo -> uid;
        $postData = [
            'pid' => 0,
            'content' => $content,
            'uid' => $uid
        ];
        $res = $this -> forum_model -> add_reply($postData); // 调用model方法 添加线下题
        if ($res) {
            $this -> showResult(0, '新增评论成功');
        } else {
            $this -> showResult(1, '评论失败 内部错误');
        }
    }

    public function del () {
        $id = $this -> input -> get('id');  // 获取传送的content参数

        $res = $this -> forum_model -> del_reply(['id' => $id]); // 调用model方法 添加线下题
        if ($res) {
            redirect('forum');
        } else {
            echo '删除失败 内部错误';
        }
    }

}
