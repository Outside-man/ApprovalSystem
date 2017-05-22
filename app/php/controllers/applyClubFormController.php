<?php

/**
 * Created by PhpStorm.
 * User: Yxm
 * Date: 2017/4/27
 * Time: 10:13
 */
class applyClubFormController extends \core\lib\BaseController {
    public function index(){
        if(isset($_SESSION['is_login'])&&$_SESSION['is_login']==0){
            Header("Location: /user/login");
            return ;
        }
        $this->display('index/index.html');
    }
    public function commitClubActivity(){
        $formClubActivityService = new app\php\service\FormClubActivityService();
        $clubService = new \app\php\service\ClubService();
        $clubInfo = $clubService->getClubByUserId($this->getCurrentUser()['id']);
        $fileId = null;
        if(isset($_FILES['applyFile'])) {
            $fileService = new \app\php\service\FileClubActivityService();
            $fileService->uploadFile($_FILES['applyFile']['tmp_name'], 'ClubActivity/', $_FILES['applyFile']['name']);
            $fileId = $fileService->getLastInsert()['id'];
        }
            $formSuccess = $formClubActivityService->commitForm($clubInfo['club_name'], $this->getCurrentUser(), $_POST['activityName'],
                $_POST['activityPlace'], $_POST['activityTime'], $_POST['activityPeople'], $_POST['isApplyFine'], $_POST['activityInfo'], $_POST['applySelfMoney'], $_POST['applyReserveMoney'], $clubInfo['id'], $fileId);
        if($formSuccess){
            $form = $formClubActivityService->getById($formClubActivityService->getLastId());
            $statusClubActivityService = new app\php\service\StatusClubActivityService();
            if($statusClubActivityService->savestatus($form, $this->getCurrentUser())) {
                $this->ajaxReturn($_POST, '提交成功', 0);
                return;
            }else{
                $formClubActivityService->deleteById($formClubActivityService->getLastId());
            }
        }
    }
    public function getListAllForm(){
        $user = $this->getCurrentUser();
        $statusClubActivityService = new \app\php\service\StatusClubActivityService();
        $data = $statusClubActivityService->getListByUserId($user['id']);
        $this->assinUser();
        $this->assign('statusList', $data);
        $this->assinConstant();
        $this->display('clubActivity/formList.html');
    }
    public function applyFormClubActivity(){
        $clubService = new \app\php\service\ClubService();
        $clubInfo = $clubService->getClubByUserId($this->getCurrentUser()['id']);
        $this->assign('user', $this->getCurrentUser());
        $this->assign('clubInfo', $clubInfo);
        $this->display("clubActivity/clubForm.html");
    }
    public function getClubActivityByUserId(){
        $statusClubActivityService = new \app\php\service\StatusClubActivityService();
        $user = $this->getCurrentUser();
        if($user!=null){
            $data = $statusClubActivityService->getListByUserId($user['id']);
            $this->ajaxReturn(json_encode($data), '获取成功', 0);
            return;
        }
    }
}