<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Forum_model extends CI_Model{

    static $_table_index = 'forum';
    static $_table_comment = 'forum_comment';

    public function get_list($queryParams){
        $queryParams['check_status'] = 1;
        return $this -> db -> get_where(self::$_table_index, $queryParams) -> result();
        // sql语句 -> 添加where子句方法 此方法生成的sql为 "SELECT * FROM forum WHERE check_status = 1;"
    }
    // 通过学号检查该学生或老师是否存在

    public function get_title_name($queryParams){
        return $this -> db -> get_where(self::$_table_index, $queryParams) -> result();
        // 此处sql为 "SELECT * FROM forum;"
    }

    public function new_forum($postData){
        return $this -> db -> insert(self::$_table_index, $postData);
        // 此处sql为 " INSERT INTO forum(field1,field2....) VALUE(v001,v002....);"
    }

    public function new_comment($postData){
        return $this -> db -> insert(self::$_table_comment, $postData);
        // 此处sql为 " INSERT INTO forum(field1,field2....) VALUE(v001,v002....);"
    }
    public function get_comment_count($postData){
        $postData['check_status'] = 1;
        return $this -> db -> get_where(self::$_table_comment, $postData) -> num_rows();
        // 此处sql为 "SELECT * FROM forum_comment WHERE check_status = 1;"
    }
    public function get_comment_by_id($queryParams){
        // where子句条件 check_status = 1 表示取出已审核的评论
        $queryParams['check_status'] = 1;
        return $this -> db -> get_where(self::$_table_comment, $queryParams) -> result();
        // 此处sql为 "SELECT * FROM forum_comment WHERE check_status = 1;"
    }

    public function del_comment($postData, $id){
        return $this -> db -> update(self::$_table_comment, $postData, ['id' => $id]);
        // 此处sql为 "UPDATE forum_comment SET column1=value1,column2=value2,WHERE id = $id;"
    }

    public function del_forum($postData, $id){
        return $this -> db -> update(self::$_table_index, $postData, ['id' => $id]);
        // 此处sql为 "UPDATE forum_comment SET column1=value1,column2=value2,WHERE id = $id;"
    }


    public function get_unaudited_comment(){
        $where = ['check_status' => 0];
        return $this -> db -> get_where(self::$_table_comment, $where) -> result();
        // 此处sql为 "SELECT * FROM forum_comment WHERE check_status = 0;"
    }

    public function get_unaudited_forum(){
        $where = ['check_status' => 0];
        return $this -> db -> get_where(self::$_table_index, $where) -> result();
        // 此处sql为 "SELECT * FROM forum WHERE check_status = 0;"
    }
}