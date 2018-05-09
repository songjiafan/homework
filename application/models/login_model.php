<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login_model extends CI_Model{

    public function check_exist($uid){
        return $this -> db -> get_where('user', array(
            'uid' => $uid
        )) -> result();
    }
    // 通过学号检查该学生或老师是否存在

    public function check_password($uid, $pwd){
        return $this -> db -> get_where('user', array('uid' => $uid, 'password' => $pwd)) -> result();
        // 此处sql为 "SELECT * FROM user WHERE uid = $uid AND password = $pwd;" result返回结果集

    }

}