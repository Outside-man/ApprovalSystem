<?php
/**
 * Created by PhpStorm.
 * User: tuanzi
 * Date: 2017/5/5
 * Time: 下午10:51
 */

namespace app\php\service;


class ApproveClubActivityService{
    static $approveClubActivityDao = null;
    function __construct(){
        self::$approveClubActivityDao = new \app\php\dao\ApproveClubActivityDao();
    }
    public function saveApprove($user, $isApprove, $formId, $comment){
        return self::$approveClubActivityDao->insert($user, $isApprove, $formId, $comment);
    }
    public function getListApproveByLv($user){
        return self::$approveClubActivityDao->selectByLv($user['lv']);
    }
    public function getApproveByLvByFormId($lv, $formId){
        return self::$approveClubActivityDao->selectByLvByFormId($lv, $formId);
    }
}