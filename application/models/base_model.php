<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class base_model extends CI_Model{

    public function get_user_by_name($username){
        return $this -> db -> get_where('user', array(
            'username' => $username
        )) -> result();
    }
    // 通过姓名获取该学生信息 返回结果集


}