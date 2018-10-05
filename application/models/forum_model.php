<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Forum_model extends CI_Model{

    static $_table_index = 'forum';

    public function get_list(){
        return $this -> db -> get_where(self::$_table_index, []) -> result();
    }

    public function reply($postData){
        return $this -> db -> insert(self::$_table_index, $postData);
    }

    public function add_reply($postData){
        return $this -> db -> insert(self::$_table_index, $postData);
    }

    public function del_reply($postData){
        return $this -> db -> delete(self::$_table_index, $postData);
    }

}