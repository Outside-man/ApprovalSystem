<?php
/**
 * Created by PhpStorm.
 * User: Yxm
 * Date: 2017/4/26
 * Time: 22:25
 */

namespace app\php\service;



class UserInfoService{
    static $userInfoDao = null;
    function __construct(){
        self::$userInfoDao = new \app\php\dao\UserInfoDao();
    }
    public function addUserDetail($id, $realName, $schoolId, $mail, $tel){
        return self::$userInfoDao->insert($id, $realName, $schoolId, $mail, $tel);
    }
    public function getUserInfoById($id){
        return self::$userInfoDao->selectById($id);
    }
    public function getRealNameById($id){
        $user = self::$userInfoDao->selectById($id);
        return $user['real_name'];
    }
}