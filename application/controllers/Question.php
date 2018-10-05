<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Question extends BASE_Controller {

    public function __construct(){
        parent::__construct();
        // 执行父类构造函数 保证登录拦截
        $this -> load -> model('question_model');
        // 默认加载model类 减少冗余代码量
    }

    public function index () {
        $title = $this -> input -> get('title');  // 获取查询的title参数
        $queryParams = [];
        if ($title) {
            $queryParams['title'] = $title;
        }

        if (empty(self::$_loginUserInfo -> is_admin)) {
            $queryParams['owner_id'] = self::$_loginUserInfo -> uid;
        } // 如果是管理员 那么不加查询过滤

        $queryParams['del'] = 0;
        $list = $this -> question_model -> get_question($queryParams); // 调用model方法 获取全部套题
        $renderData = [
            'admin' => self::$_loginUserInfo -> is_admin,
            'role' => self::$_loginUserInfo -> role,
            'username' => self::$_loginUserInfo -> username,
            'list' => $list
        ];
        $this -> load -> view('question_table', $renderData);
        // 渲染 带一个是否管理员参数
    }

    public function add () {
        // 新增套题
        $postData = [];
        $postData['title'] = $this -> input -> post('title'); // 获取套题标题参数
        $postData['content_question'] = $this -> input -> post('content_question'); // 获取主观题题干
        $postData['select_question'] = $this -> input -> post('select_question'); // 获取客观题题干
        $postData['select_content'] = $this -> input -> post('select_content'); // 获取客观题内容
        $postData['select_answer'] = $this -> input -> post('select_answer'); // 获取客观题答案
        $postData['start_time'] = $this -> input -> post('start_time'); // 获取答题开始时间参数
        $postData['end_time'] = $this -> input -> post('end_time'); // 获取答题结束时间参数
        // 接受$.post传过来的参数
        $postData['owner_id'] = self::$_loginUserInfo -> uid;
        $postData['del'] = 0;
        // 参数补充
        $addRes = $this -> question_model -> new_question_bank($postData); // 调用model方法 添加套题

        if ($addRes) {
            $this -> showResult(0, '生成套题成功');
        } else {
            $this -> showResult(1, '发布失败 内部错误');
        }
        // 判断返回值来确定返回json的参数
    }

    public function del () {
        // 删除套题
        $postData = [];
        $id = $this -> input -> get('id');
        $postData['del'] = 1;
        // 参数补充
        $delRes = $this -> question_model -> del_question_bank($postData, $id);
        // 调用删除方法
        if ($delRes) {
            $this -> showResult(0, '删除套题成功');
        } else {
            $this -> showResult(1, '删除失败 内部错误');
        }
        // 判断返回值来确定返回json的参数
    }
    public function del_offline () {
        // 删除套题
        $id = $this -> input -> get('id');
        // 参数补充
        $delRes = $this -> question_model -> del_offline($id);
        // 调用删除方法
        if ($delRes) {
            $this -> showResult(0, '删除套题成功');
        } else {
            $this -> showResult(1, '删除失败 内部错误');
        }
        // 判断返回值来确定返回json的参数
    }

    public function answer () {
        // 答题接口
        $questionId =  $this -> input -> post('id'); // 套题id
        $select = $this -> input -> post('select_content'); // 客观题答案
        $subjective = $this -> input -> post('subjective'); // 主观题答案
        $studentId = self::$_loginUserInfo -> uid; // 答题人
        // 计算客观题得分
        $ownArr = explode(',', $select); // 分割成10个选项的数组
        $data = $this -> question_model -> get_question(['del' => 0, 'id' => $questionId]); // 根据套题id 查询出本套题的正确答案
        $arr = explode(',', $data[0]->select_answer); // 将正确答案也分割成数组
        $score = 0; // 初始化得分
        for ($i = 0; $i < 10; $i++) {
            if ($ownArr[$i] == $arr[$i]) {
                $score = $score + 5;
            }
        } // 遍历数组 如果答案是正确的就递增5分
        $postData = [
            'select_score' => $score,
            'select' => $select,
            'student_id' => $studentId,
            'question_id' => $questionId,
            'subjective' => $subjective,
        ]; // 参数补充
        $res = $this -> question_model -> get_question_history(['student_id' => $studentId, 'question_id' => $questionId]); // 查询是否答过这套题
        if (empty($res)) { // 未答过时 将答题记录
            $answerRes = $this -> question_model -> answer_question_history($postData);
            if ($answerRes) {
                $this -> showResult(0, '答题成功');
            } else {
                $this -> showResult(1, '答题失败 内部错误');
            }
        } else { // 答过
            $answerRes = $this -> question_model -> update_question_history($postData, $questionId, $studentId);
            if ($answerRes) { // 答过时 更新答案
                $this -> showResult(0, '更新答题成功');
            } else {
                $this -> showResult(1, '更新答题失败 内部错误');
            }
        }

    }
    public function offline () {
        $title = $this -> input -> get('title');  // 获取查询的title参数
        $queryParams = [];
        if ($title) {
            $queryParams['title'] = $title;
        }

        if (empty(self::$_loginUserInfo -> is_admin)) {
            $queryParams['owner_id'] = self::$_loginUserInfo -> uid;
        } // 如果是管理员 那么不加查询过滤

        $queryParams['del'] = 0;
        $list = $this -> question_model -> get_offline_question($queryParams); // 调用model方法 获取全部套题
        $renderData = [
            'admin' => self::$_loginUserInfo -> is_admin,
            'role' => self::$_loginUserInfo -> role,
            'username' => self::$_loginUserInfo -> username,
            'list' => $list
        ];
        $this -> load -> view('question_offline', $renderData);
    }

    public function offline_history () {
        $list = $this -> question_model -> get_offline_history(['forum' => '']); // 调用model方法 获取全部套题
        $renderData = [
            'admin' => self::$_loginUserInfo -> is_admin,
            'role' => self::$_loginUserInfo -> role,
            'username' => self::$_loginUserInfo -> username,
            'list' => $list
        ];
        $this -> load -> view('offline_history', $renderData);
    }

    public function add_offline () {
        $title = $this -> input -> post('title');  // 获取传送的title参数
        $end_time = $this -> input -> post('end_time');  // 获取传送的end_time参数
        $own_id = self::$_loginUserInfo -> uid;
        $postData = [
            'title' => $title,
            'end_time' => $end_time,
            'owner_id' => $own_id
        ];
        $res = $this -> question_model -> add_offline($postData); // 调用model方法 添加线下题
        if ($res) {
            $this -> showResult(0, '新增成功');
        } else {
            $this -> showResult(1, '新增线下作业失败 内部错误');
        }
    }
    public function download () {
        $this->load->helper('download'); // 加载下载工具
        $name = $this -> input -> get('filename'); //获取文件名
        $data = './uploads/'.$name;
        force_download($data, NULL); // 框架自带下载方法
    }

}
