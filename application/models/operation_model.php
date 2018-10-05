<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Operation_model extends CI_Model{

    static $_table_index = 'user';

    public function get_user(){
        return $this -> db -> get_where(self::$_table_index, ['is_admin' => 0]) -> result();
    }

    public function get_user_by_uid($uid){
        return $this -> db -> get_where(self::$_table_index, ['uid' => $uid]) -> result();
    }

    public function del_user($id){
        $this -> db -> delete('homework', ['owner_id' => $id]);
        $this -> db -> delete('question_history', ['student_id' => $id]);
        $this -> db -> delete('offline', ['owner_id' => $id]);
        $this -> db -> delete('offline_history', ['teacher_id' => $id]);
        $this -> db -> delete('offline_history', ['student_id' => $id]);
        $this -> db -> delete('file', ['own_id' => $id]);
        $this -> db -> delete('forum', ['uid' => $id]);
        $this -> db -> delete('forum', ['pid' => $id]);
        return $this -> db -> delete(self::$_table_index, ['id' => $id]); // 删除有关于用户的所有表
    }

    public function del_file($id){
        return $this -> db -> delete('file', ['id' => $id]);
    }

    public function add_user($postData){
        return $this -> db -> insert(self::$_table_index, $postData);
    }
}