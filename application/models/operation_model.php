<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Operation_model extends CI_Model{

    static $_table_index = 'forum';
    static $_table_comment = 'forum_comment';

    public function change_forum($postData, $id){
        return $this -> db -> update(self::$_table_index, $postData, ['id' => $id]);
    }

    public function change_comment($postData, $id){
        return $this -> db -> update(self::$_table_comment, $postData, ['id' => $id]);
    }

}