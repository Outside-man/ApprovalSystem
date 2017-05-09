<?php
/**
 * Created by PhpStorm.
 * User: tuanzi
 * Date: 2017/5/3
 * Time: 下午3:56
 */

namespace app\php\service;


class ClubService{
    static $clubDao = null;
    function __construct(){
        self::$clubDao = new \app\php\dao\ClubDao();
    }
    public function getClubByUserId($userId){
        return self::$clubDao->selectClubByUserId($userId);
    }
    public function changeMoneyById($self_money, $reserve_money, $id){
        return self::$clubDao->updateMoneyById($self_money, $reserve_money, $id);
    }
    public function getClubById($id){
        return self::$clubDao->selectById($id);
    }
}