<?php
/**
 * Created by PhpStorm.
 * User: TuanZ
 * Date: 2017/4/18
 * Time: 14:01
 */
/**
 * 入口文件
 * 1.定义常量
 * 2.加载库
 * 3.启动框架
 */
define('TuanZ', realpath(' /'));
define('CORE', TuanZ.'core/');
define('APP', TuanZ.'app/');
define('PHP', APP.'php/');
define('CONFIG', TuanZ.'config/');
define('WEB', APP.'web/');
define('VIEW', WEB.'views/');
define('_STATIC_', '/'.WEB.'static/');
define('CONTROLLER', PHP.'controllers/');
define('DAO', PHP.'dao/');
define('SERVICE', PHP.'service/');
define('DEBUG', true);

//开启DEBUG
if(DEBUG){
    ini_set('display_errors', 'On');
}else{
    ini_set('display_errors', 'Off');
}
include CORE.'common/test.php';

include CORE.'tuanz.php';

include CORE.'lib/DataBase.php';

include CORE.'common/tools.php';

session_start();

spl_autoload_register('\core\tuanz::load');


//项目中所需的常量
//define('ARR_APPROVE_LV', array(
//    2 => "提交成功",
//    3 => "社联财务审核通过",
//    4 => "社联主席审核通过",
//    5 => "社联指导老师审核通过",
//    6 => "后勤部门审核通过"
//));
//define('FORM_STATUS', array(
//    0 => "审核中",
//    1 => "已通过",
//    2 => "未通过"
//));
core\tuanz::run();
