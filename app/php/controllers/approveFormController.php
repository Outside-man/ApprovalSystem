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
        $data = $formClubActivityService->getById($_GET['id']);
        $this->assign('data',$data);
        $this->display('clubActivity/clubActivityform.html');
    }
    public function listClubActivity(){
        $user = $this->getCurrentUser();
        if($user['lv']<2){
            Header("Location: /user/login");
            return ;
        }else{
                $statusClubActivityService = new \app\php\service\StatusClubActivityService();
                $data = $statusClubActivityService->getAll();
                $this->assinUser();
                $this->assign('statusList', $data);
                $this->display('clubActivity/formList.html');
//            }else {
//                $statusClubActivityService = new \app\php\service\StatusClubActivityService();
//                $data = $statusClubActivityService->getListByNowLv($user['lv']);
//                $this->assinUser();
//                $this->assign('list', $data);
//                $this->display('clubActivity/formList.html');
//            }
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