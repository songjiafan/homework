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
        // 第二版写模糊查询 第一版先不加查询功能
        // $comment = $this -> input -> get('comment');
        $forumList = $this -> forum_model -> get_list([]);
        foreach ($forumList as $item) {
            $commentData = $this -> forum_model -> get_comment_count(array('forum_id' => $item -> id));
            $item -> count = $commentData;
        }
        $renderData = [];
        $renderData['forumList'] = $forumList;
        $renderData['admin'] = self::$_loginUserInfo -> role == 1;
        $this -> load -> view('forum', $renderData);
    }

    public function add () {
        // 新增文章
        $postData = [];
        $postData['title'] = $this -> input -> post('title');
        $postData['content'] = $this -> input -> post('content');
        // 接受$.post传过来的参数
        $postData['check_status'] = 0;
        $postData['author_id'] = self::$_loginUserInfo -> uid;
        $postData['author_username'] = self::$_loginUserInfo -> username;
        // 参数补充
        $addRes = $this -> forum_model -> new_forum($postData);
        // 调用新增方法
        if ($addRes) {
            $this -> showResult(0, '发布成功 等待审核');
        } else {
            $this -> showResult(1, '发布失败 内部错误');
        }
        // 判断返回值来确定返回json的参数
    }

    public function content () {
        // 查询每个页面内容
        $queryParams = [];
        $queryParams['id'] = $this -> input -> get('forum_id');
        // 获取url中的forum_id参数
        $forumData = $this -> forum_model -> get_list($queryParams);
        $commentData = $this -> forum_model -> get_comment_by_id(array('forum_id' => $forumData[0] -> id));
        // 获取页面基本信息 包括帖子内容和评论
        $renderData = [];
        $renderData['commentData'] = $commentData;
        $renderData['forumData'] = $forumData[0];
        $renderData['admin'] = self::$_loginUserInfo -> role;
        // 渲染参数初始化 填充 权限
        $this -> load -> view('forum_content', $renderData);
        // 渲染
    }

    public function add_comment () {
        // 新增评论
        $postData = [];
        $postData['forum_id'] = $this -> input -> post('forum_id');
        $postData['content'] = $this -> input -> post('content');
        // 获取$.post发送来的参数
        $postData['check_status'] = 0;
        $postData['create_time'] = date('Y-m-d H:i:s');
        $postData['author_id'] = self::$_loginUserInfo -> uid;
        $postData['author_username'] = self::$_loginUserInfo -> username;

        $addRes = $this -> forum_model -> new_comment($postData);
        if ($addRes) {
            $this -> showResult(0, '评论成功 等待审核');
        } else {
            $this -> showResult(1, '评论失败 内部错误');
        }
    }

    public function del_comment () {
        // 删除评论
        $postData = [];
        $id = $this -> input -> post('id');
        $postData['check_status'] = 2;
        // 2为审核不通过 下同
        $delRes = $this -> forum_model -> del_comment($postData, $id);
        if ($delRes) {
            $this -> showResult(0, '删除成功');
        } else {
            $this -> showResult(1, '删除失败 内部原因');
        }
    }

    public function del_forum () {
        // 删除文章
        $postData = [];
        $id = $this -> input -> post('id');
        $postData['check_status'] = 2;
        $delRes = $this -> forum_model -> del_forum($postData, $id);
        if ($delRes) {
            $this -> showResult(0, '删除成功');
        } else {
            $this -> showResult(1, '删除失败 内部原因');
        }
    }

}
