<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Student extends BASE_Controller {

    public function __construct(){
        parent::__construct();
        // 执行父类构造函数 保证登录拦截
        $this -> load -> model('question_model');
        // 默认加载model类 减少冗余代码量
    }

    public function index () {
        $title = $this -> input -> get('title');
        $queryParams = [];
        if ($title) {
            $queryParams['title'] = $title;
        }
        // $queryParams['owner_id'] = self::$_loginUserInfo -> uid;
        $queryParams['del'] = 0;
        $list = $this -> question_model -> get_question($queryParams);
        $renderData = [
            'admin' => self::$_loginUserInfo -> is_admin,
            'role' => self::$_loginUserInfo -> role,
            'username' => self::$_loginUserInfo -> username,
            'list' => $list
        ];
        $this -> load -> view('student_answer', $renderData);
        // 渲染 带一个是否管理员参数
    }

    public function score () {
        $queryParams = [];
        $queryParams['finish'] = 1;
        $queryParams['student_id'] = self::$_loginUserInfo -> uid;
        $list = $this -> question_model -> get_question_history($queryParams);
        $renderData = [
            'admin' => self::$_loginUserInfo -> is_admin,
            'role' => self::$_loginUserInfo -> role,
            'username' => self::$_loginUserInfo -> username,
            'list' => $list
        ];
        $this -> load -> view('student_score', $renderData);
        // 渲染 带一个是否管理员参数
    }

    public function offline () {
        $list = $this -> question_model -> get_offline_question(['del' => 0]);
        $renderData = [
            'admin' => self::$_loginUserInfo -> is_admin,
            'role' => self::$_loginUserInfo -> role,
            'username' => self::$_loginUserInfo -> username,
            'list' => $list
        ];
        $this -> load -> view('offline', $renderData);
        // 渲染 带一个是否管理员参数
    }

    public function offline_history () {
        $this -> load -> model('login_model');
        $list = $this -> question_model -> get_offline_history_student(['student_id' => self::$_loginUserInfo -> uid]);
        foreach ($list as $k => $v) {
            $name = $this -> login_model -> check_exist($v->teacher_id);
            $v->teacher_name = $name[0] -> username;
        }
        $renderData = [
            'admin' => self::$_loginUserInfo -> is_admin,
            'role' => self::$_loginUserInfo -> role,
            'username' => self::$_loginUserInfo -> username,
            'list' => $list
        ];
        $this -> load -> view('student_offline', $renderData);
        // 渲染 带一个是否管理员参数
    }

    public function do_upload () {
        $config['upload_path']      = getcwd().'/uploads';
        $config['allowed_types']    = '*';
        $config['overwrite']      = true; // 重名覆盖
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('userfile')) {
           $postData = [
               'student_id' => self::$_loginUserInfo -> uid,
               'teacher_id' => $this -> input -> post('teacher_id'),
               'question_id' => $this -> input -> post('question_id'),
               'filename' => $this->upload->data('file_name')
            ];
           $checkRes = $this -> question_model -> get_offline_history(array(
               'student_id' => self::$_loginUserInfo -> uid,
               'teacher_id' => $this -> input -> post('teacher_id'),
               'question_id' => $this -> input -> post('question_id'),
           )); // 检查是否提交过作业 提交过的 用update 如果没有提交过 用insert插入
           if ($checkRes) {
               $res = $this -> question_model -> update_offline_history($postData, ['id' => $checkRes[0]->id]);
           } else {
               $res = $this -> question_model -> add_offline_history($postData);
           }

           if ($res) {
               redirect('welcome');
           } else {
               echo '上传失败 内部错误 请重新上传';
           }
        } else {
            echo '上传失败 请重新上传';
            echo '上传失败 错误原因'.$this->upload->display_errors();
            return false;
        }
    }
}
