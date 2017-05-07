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
        $isSuccess = $formClubActivityService->commitForm($_POST['club'], $this->getCurrentUser(),$_POST['activityName'],
            $_POST['activityPlace'], $_POST['activityTime'], $_POST['activityPeople'], $_POST['isApplyFine'], $_POST['activityInfo'], $_POST['applySelfMoney'], $_POST['applyCommonMoney']);
        if($isSuccess){
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
        $this->display('clubActivity/formList.html');
    }
}