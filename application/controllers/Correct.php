<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Correct extends BASE_Controller {

    public function __construct(){
        parent::__construct();
        // 执行父类构造函数 保证登录拦截
        $this -> load -> model('question_model');
        // 默认加载model类 减少冗余代码量
    }

    public function index () {
        $user = self::$_loginUserInfo -> uid;
        $res = $this -> question_model -> get_question(array('owner_id' => $user)); // 查询出当前登录教师的全部套题
        // 根据登录人的id 获取该用户所有未批改的用户
        $questionIds = array_column($res, 'id'); // 取出这些套题的id 拼成数组
        $questionContent = array_column($res, 'content_question'); // 取出这些套题的题干 拼成数组
        $questionList = $this -> question_model -> get_correct_questions($questionIds); // 将这些套题id相关的答题记录查询出来
        $renderData = [
            'admin' => self::$_loginUserInfo -> is_admin,
            'role' => self::$_loginUserInfo -> role,
            'username' => self::$_loginUserInfo -> username,
            'list' => $questionList,
            'content' => $questionContent
        ];
        $this -> load -> view('correct', $renderData); // 页面渲染
    }

    public function correct () {
        // 查询教师用户的全部套题
        $firstScore = $this -> input -> post('subjective_first_score');
        $secondScore = $this -> input -> post('subjective_second_score');
        $id = $this -> input -> post('id');
        $postData = [
            'subjective_first_score' => $firstScore,
            'subjective_second_score' => $secondScore,
            'finish' => 1
        ]; // 第一道题分数 第二道题分数 完成参数
        $res = $this -> question_model -> correct_questions($postData, $id);
        if ($res) {
            $this -> showResult(0, '批改成功');
        } else {
            $this -> showResult(1, '批改失败 内部错误');
        }

    }

    public function offline () {
        $forum = $this -> input -> post('forum');
        $id = $this -> input -> post('id');
        $postData = [
            'forum' => $forum,
        ];
        $res = $this -> question_model -> correct_offline($postData, $id); // 批改评语
        if ($res) {
            $this -> showResult(0, '批改成功');
        } else {
            $this -> showResult(1, '批改失败 内部错误');
        }
    }

    public function file () {
        $renderData = [
            'admin' => self::$_loginUserInfo -> is_admin,
            'role' => self::$_loginUserInfo -> role,
            'username' => self::$_loginUserInfo -> username,
        ];
        $this -> load -> view('file', $renderData); // 页面渲染
    }

    public function do_upload () {
        $config['upload_path']      = getcwd().'/uploads'; // 获取绝对路径 此处有坑 相对路径会报错
        $config['allowed_types']    = '*'; // 允许所有类型文件上传 不加会报错
        $config['overwrite']      = true; // 重名覆盖节省内存空间
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('userfile')) {
            $postData = [
                'own_id' => self::$_loginUserInfo -> uid,
                'filename' => $this->upload->data('file_name')
            ];
            $res = $this -> question_model -> add_file($postData);
            if ($res) {
                redirect('welcome');
            } else {
                echo '上传失败 内部错误 请重新上传';
            }

        } else {
            echo '上传失败 错误原因'.$this->upload->display_errors(); // 打出错误日志 多数情况由于Windows系统的文件权限坑 正常这里应该 chmod -R 777
            echo '上传失败 请重新上传';
            return false;
        }
    }
}
