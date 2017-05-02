<?php
/**
 * Created by PhpStorm.
 * User: Yxm
 * Date: 2017/4/27
 * Time: 11:18
 */

namespace app\php\service;


class StatusClubActivityService{
    static $statusClubActivityDao = null;
    function __construct(){
        self::$statusClubActivityDao = new \app\php\dao\StatusClubActivityDao();
    }
    public function getByNowUserId($userId){
        return self::$statusClubActivityDao->selectByNowUserId($userId);
    }
    public function getAll(){
        return self::$statusClubActivityDao->selectAll();
    }
    public function  getById($id){
        return self::$statusClubActivityDao->selectById($id);
    }
    public function savestatus($form, $nowUserId, $user){
        return self::$statusClubActivityDao->insert($form, $nowUserId, $user);
    }
    public function getListByUserId($formUserId){
        return self::$statusClubActivityDao->selectByFormUserId($formUserId);
    }
}