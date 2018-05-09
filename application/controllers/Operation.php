<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operation extends BASE_Controller {

    public function __construct(){
        parent::__construct();
        // 执行父类构造函数 保证登录拦截
        $this -> load -> model('forum_model');
        $this -> load -> model('operation_model');
        // 默认加载model类 减少冗余代码量
    }

    public function index(){
        if (self::$_loginUserInfo -> role != 1) {
            redirect('welcome','location');
            //判断登陆者是否有管理员权限 没有的话重定向到主页
        }

        $commentList = $this -> forum_model -> get_unaudited_comment();
        // 获取未审核论坛评论列表
        $forumList = $this -> forum_model -> get_unaudited_forum();
        // 获取未审核论坛帖子列表
        foreach ($commentList as $item) {
            $title = $this -> forum_model -> get_title_name(array('id' => $item -> forum_id));
            $item -> title = $title[0] -> title;
        }
        //遍历 将评论列表的评论的文章标题填充进数据中
        $renderData = [];
        // 初始化渲染数据
        $renderData['commentList'] = $commentList;
        $renderData['forumList'] = $forumList;
        $renderData['admin'] = self::$_loginUserInfo -> role;
        // 渲染数据填充
        $this -> load -> view('operation', $renderData);
        // 渲染页面
    }

    public function check_forum(){
        // 审核帖子接口
        $id = (int)$this -> input -> get('id');
        $check_status = (int)$this -> input -> get('status');
        $this -> operation_model -> change_forum(array('check_status' => $check_status), $id);
        // 此处逻辑较为简单 不容易报错 因为amazeui confim组件过于繁琐 故不加判断 直接重定向 下同
        redirect('operation','location');
    }

    public function check_comment(){
        // 审核评论接口
        $id = (int)$this -> input -> get('id');
        $check_status = (int)$this -> input -> get('status');
        $this -> operation_model -> change_comment(array('check_status' => $check_status), $id);
        redirect('operation','location');
    }

    public function check_forum_comment(){
        // 审核帖子评论接口

    }
}
