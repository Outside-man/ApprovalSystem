<?php
/**
 * Created by PhpStorm.
 * User: Yxm
 * Date: 2017/5/16
 * Time: 16:26
 */

namespace app\php\service;
class AdminService{
    static $adminDao = null;
    public function __construct(){
        self::$adminDao = new \app\php\dao\AdminDao();
    }
    public function loginCheck($username, $password){
        $admin = null ;
        try {
            $admin = self::$adminDao->selectByUsername($username);
            if(is_null($admin)) throw new \Exception('账号不存在');
            if($password == $admin['password'])
                return $admin;
            else
                return null;
        }catch (\Exception $e){
            return null;
        }
    }
    public function listUserInfo(){
        $userInfoDao = new \app\php\dao\UserInfoDao();
        $listUserInfo = $userInfoDao->selectAll();
        return $listUserInfo;
    }
}