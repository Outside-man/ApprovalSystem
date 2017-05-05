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
    public function getAll(){
        return self::$statusClubActivityDao->selectAll();
    }
    public function  getById($id){
        return self::$statusClubActivityDao->selectById($id);
    }
    public function savestatus($form, $user){
        return self::$statusClubActivityDao->insert($form, $user);
    }
    public function getListByUserId($formUserId){
        return self::$statusClubActivityDao->selectByFormUserId($formUserId);
    }
    public function getListByNowLv($approveLv){
        return self::$statusClubActivityDao->selectByNowLv($approveLv);
    }
}