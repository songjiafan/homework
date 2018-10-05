<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Password_model extends CI_Model{

    static $_table_index = 'user';

    public function check_pwd($postData){
        return $this -> db -> get_where(self::$_table_index, $postData);
    }
    public function change_pwd($postData, $uid){
        return $this -> db -> update(self::$_table_index, $postData, ['uid' => $uid]);
    }

}