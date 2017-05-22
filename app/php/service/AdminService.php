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
    static $userInfoDao = null;
    static $userDao = null;
    public function __construct(){
        self::$adminDao = new \app\php\dao\AdminDao();
        self::$userInfoDao = new \app\php\dao\UserInfoDao();
        self::$userDao = new \app\php\dao\UserDao();
    }
    public function loginCheck($username, $password){
        $admin = null ;
        try {
            $admin = self::$adminDao->selectAdminByUsername($username);
            if(is_null($admin)) throw new \Exception('账号不存在');
            if($password == $admin['password'])
                return $admin;
            else
                return null;
        }catch (\Exception $e){
            return null;
        }
    }
    public function listAllUser(){
        return self::$userDao->selectAll();
    }
    public function getUserById($id){
        return self::$userDao->selectById($id);
    }
    public function setPasswordUser($password, $id){
        if(self::getUserById($id)==null)die("用户不存在");
        return self::$userDao->updatePasswordById($password, $id);
    }


    public function listAllUserInfo(){
        $listUserInfo = self::$userInfoDao->selectAll();
        return $listUserInfo;
    }
    public function getUserInfoById($id){
        return self::$userInfoDao->selectById($id);
    }
    public function setUserInfo($userInfo, $id){
        if(self::getUserInfoById($id)==null)die("用户不存在");
        return self::$userInfoDao->updateUserInfo($userInfo,$id);
    }
}