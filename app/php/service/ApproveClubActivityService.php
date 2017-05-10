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
    public function saveApprove($user, $isApprove, $formId, $comment, $club_id, $apply_self_money, $apply_reserve_money){
        if($user['lv']==4) {
            $statusClubActivityDao = new \app\php\dao\StatusClubActivityDao();
            $formClubActivityDao = new \app\php\dao\FormClubActivityDao();
            $clubDao = new \app\php\dao\ClubDao();
            $club = $clubDao->selectById($club_id);
            if ($isApprove == 1) {
                $statusClubActivityDao->updateStatusByFormId(1, $formId);
                //将当前的金额存入申请表
                $formClubActivityDao->updateMoneyFormById($club['self_money'], $club['reserve_money'], $formId);
                //修改社团余额
                $clubDao->updateMoneyById($club['self_money']-$apply_self_money, $club['reserve_money']-$apply_reserve_money, $club_id);
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