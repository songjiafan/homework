<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Question_model extends CI_Model{

    static $_table_index = 'homework';
    static $_table_history = 'question_history';
    static $_table_offline = 'offline';
    static $_table_offline_history = 'offline_history';

    public function get_question($postData){
        return $this -> db -> get_where(self::$_table_index, $postData) -> result();
    }

    public function get_offline_question($postData){
        return $this -> db -> get_where(self::$_table_offline, $postData) -> result();
    }

    public function new_question_bank($postData){
        return $this -> db -> insert(self::$_table_index, $postData);
        // 此处sql为 " INSERT INTO homework(field1,field2....) VALUE(v001,v002....);"
    }

    public function del_question_bank($postData, $id){
        return $this -> db -> update(self::$_table_index, $postData, ['id' => $id]);
    }

    public function get_question_history($params){
        return $this -> db -> get_where(self::$_table_history, $params) -> result();
    }

    public function answer_question_history($postData){
        return $this -> db -> insert(self::$_table_history, $postData);
    }

    public function update_question_history($postData, $questionId, $studentId){
        return $this -> db -> update(self::$_table_history, $postData, ['question_id' => $questionId, 'student_id' => $studentId]);
    }

    public function get_correct_questions($postData){
        $this -> db -> where(['finish' => 0]);
        if ($postData) {
            $this -> db -> where_in('question_id', $postData);
        } // 解决报错
        return $this -> db -> get(self::$_table_history) -> result();
    }

    public function correct_questions($postData, $id){
        return $this -> db -> update(self::$_table_history, $postData, ['id' => $id]);
    }

    public function add_offline($postData){
        return $this -> db -> insert(self::$_table_offline, $postData);
    }

    public function del_offline($id){
        return $this -> db -> update(self::$_table_offline, ['del' => 1], ['id' => $id]);
    }

    public function add_offline_history($postData){
        return $this -> db -> insert(self::$_table_offline_history, $postData);
    }

    public function correct_offline($postData, $id){
        return $this -> db -> update(self::$_table_offline_history, $postData, ['id' => $id]);
    }

    public function get_offline_history($postData){
        return $this -> db -> get_where(self::$_table_offline_history, $postData) -> result();
    }
    public function get_offline_history_student($postData){
        $this->db->where('forum !=', '');
        return $this -> db -> get_where(self::$_table_offline_history, $postData) -> result();
    }

    public function update_offline_history($postData, $where){
        return $this -> db -> update(self::$_table_offline_history, $postData, $where);
    }

    public function add_file($postData){
        return $this -> db -> insert('file', $postData);
    }
}