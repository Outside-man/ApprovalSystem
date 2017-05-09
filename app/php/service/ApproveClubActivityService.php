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
        if($user['lv']==4) {
            $statusClubActivityDao = new \app\php\dao\StatusClubActivityDao();
            $formClubActivityDao = new \app\php\dao\FormClubActivityDao();
            if ($isApprove == 1) {
                $statusClubActivityDao->updateStatusByFormId(1, $formId);
                //TODO 将当前的社团金额存入
                $formClubActivityDao->updateMoneyFormById($selfMoney, $reserve_money, $formId);
            }
            if ($isApprove == 0)
                $statusClubActivityDao->updateStatusByFormId(2, $formId);
        }
        return self::$approveClubActivityDao->insert($user, $isApprove, $formId, $comment);
    }
    public function getListApproveByLv($user){
        return self::$approveClubActivityDao->selectByLv($user['lv']);
    }
    public function getApproveByLvByFormId($lv, $formId){
        return self::$approveClubActivityDao->selectByLvByFormId($lv, $formId);
    }
    public function getApproveByFormId($formId){
        return self::$approveClubActivityDao->selectByFormId($formId);
    }
}