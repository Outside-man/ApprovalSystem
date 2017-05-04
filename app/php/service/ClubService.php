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
    public function getClubById($id){
        return self::$clubDao->selectClubByUserId($id);
    }
    public function changeMoneyById($change, $id){
        return self::$clubDao->updateMoneyById($change, $id);
    }
}