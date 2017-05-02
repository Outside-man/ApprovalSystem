<?php
/**
 * Created by PhpStorm.
 * User: TuanZ
 * Date: 2017/4/24
 * Time: 19:28
 */

namespace app\php\service;

class UserService{
    static $userDao = null;
    function __construct(){
        self::$userDao = new \app\php\dao\UserDao();
    }
    public function loginCheck($username, $password){
        $user = null ;
        try {
            $user = self::$userDao->selectByUsername($username);
            if(is_null($user)) throw new \Exception('账号不存在');
            if($password == $user['password'])
                return $user;
            else
                return null;
        }catch (\Exception $e){
            return null;
        }
    }
    public function register($username, $password){
        return self::$userDao->insert($username, $password);
    }
    public function getUserByUsername($username){
        return self::$userDao->selectByUsername($username);
    }
    public function deleteById($id){
        return self::$userDao->delById($id);
    }
}