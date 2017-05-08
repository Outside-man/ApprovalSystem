<?php

/**
 * Created by PhpStorm.
 * User: Yxm
 * Date: 2017/4/27
 * Time: 11:25
 */
class approveFormController extends \core\lib\BaseController {
    public function index(){
        if(isset($_SESSION['is_login'])&&$_SESSION['is_login']==0){
            Header("Location: /user/login");
            return ;
        }
        $this->display('index/index.html');
    }
    public function getClubActivityByUserId(){
        $statusClubActivityService = new \app\php\service\StatusClubActivityService();
        $user = $this->getCurrentUser();
        if($user!=null){
            $data = $statusClubActivityService->getByUserId($user['id']);
            $this->ajaxReturn(json_encode($data), '获取成功', 0);
            return;
        }
    }
    public function getClubActivityById(){
        $formClubActivityService = new app\php\service\FormClubActivityService();
        $approveClubActivityService = new app\php\service\ApproveClubActivityService();
        $userInfoService = new app\php\service\UserInfoService();
        $approve_pre = $approveClubActivityService->getApproveByFormId($_GET['id']);
        $approve_lv_2 = array();//社联财务
        $approve_lv_3 = array();//社联主席
        $approve_lv_4 = array();//指导老师
        if(is_array($approve_pre)) {
            forEach ($approve_pre as $key){
                if($key['lv']==2) {
                    $approve_lv_2 = array(
                        'lv' => $key['lv'],
                        'comment' => $key['comment'],
                        'is_approve' => $key['is_approve'],
                        'name' => $userInfoService->getRealNameById($key['approve_user_id'])
                    );
                }
                if($key['lv']==3) {
                    $approve_lv_3 = array(
                        'lv' => $key['lv'],
                        'comment' => $key['comment'],
                        'is_approve' => $key['is_approve'],
                        'name' => $userInfoService->getRealNameById($key['approve_user_id'])
                    );
                }
                if($key['lv']==4) {
                    $approve_lv_4 = array(
                        'lv' => $key['lv'],
                        'comment' => $key['comment'],
                        'is_approve' => $key['is_approve'],
                        'name' => $userInfoService->getRealNameById($key['approve_user_id'])
                    );
                }

            }
        }

        $form = $formClubActivityService->getById($_GET['id']);
        $this->assign('approve_lv_2', $approve_lv_2);
        $this->assign('approve_lv_3', $approve_lv_3);
        $this->assign('approve_lv_4', $approve_lv_4);
        $this->assign('form',$form);
        $this->display('clubActivity/clubActivityform.html');
    }
    public function listClubActivity(){
        $user = $this->getCurrentUser();
        if($user['lv']<2){
            Header("Location: /user/login");
            return ;
        }else{
            $statusClubActivityService = new \app\php\service\StatusClubActivityService();
            $data = $statusClubActivityService->getListFormByLv($user);
            $this->assinUser();
            $this->assign('statusList', $data);
            $this->assinConstant();
            $this->display('clubActivity/formList.html');
        }
    }
    public function gotoApproveById(){
        $approveClubActivityService = new \app\php\service\ApproveClubActivityService();
        $formClubActivityService = new app\php\service\FormClubActivityService();
        $data = $formClubActivityService->getById($_GET['id']);
        $user = $this->getCurrentUser();
        $comment = $approveClubActivityService->getApproveByLvByFormId($user['lv'], $_GET['id']);
        $this->assign('user', $user);
        out($comment);
        if(!$comment){
            $this->assign('data', $data);
            $this->display('clubActivity/clubApprove.html');
        }else {
            $this->assign('comment', $comment);
            $this->assign('data', $data);
        }

    }
    public function approveForm(){
        $approveClubActivityService = new \app\php\service\ApproveClubActivityService();
        if($approveClubActivityService->saveApprove($this->getCurrentUser(), $_POST['is_approve'], $_POST['form_id'] ,$_POST['comment'])){
            $statusClubActivityService = new \app\php\service\StatusClubActivityService();
            $statusClubActivityService->changeApproveLvByFormId($this->getCurrentUser(), $_POST['form_id']);
            $this->ajaxReturn(null, '审核成功', 0);
            return ;
        }
        $this->ajaxReturn(null, '审核异常', 1);
    }
}