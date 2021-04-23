<?php

/**
 * Emlog API administrative
 * 
 * @author   1.0
 * @package  Emlog Pro
 * 
 * 
 * This api can be used by customer and developers, and can be in DIY
 * 
 * 
 */

if (!defined('EP_API_Core')) {
    define('EP_API_Core', true);
}

/** 载入 Emlog Pro 引导 */
require_once 'init.php';
error_reporting(0);

header('Content-type: application/json;charset=utf-8');
header('X-Robots-Tag: noindex');

if (empty($_REQUEST['action']))
    die("请规范使用此 Api - Desgin & Compile by MrTang");

/** 加载数据请求管理类别  */
require_once './includes/request.class.php';

/** 加载所支持函数请求管理 API 库  */
require_once './includes/admins.php';

/** 加载 API 所需默认函数库  */
require_once './includes/api-functions.php';

// 开启数据库连接
$db = Database::getInstance();

/**
 * 支持请求为 Get 的数据
 * 
 * @return array
 */
$api_get_request = array(

    /** 指定某条评论 >>> @example API?action=comments-logs&cid={Comments Id} */
    //"comments-logs",

    /** 指定某文章内容 >>> @example API?action=logs-content&lid={Logs Id} */
    //"logs-content",

    /** 获取所有分类 >>> @example API?action=category */
    "category",

    /** 获取所有友情链接 >>> @example API?action=links */
    "links",

    /** 获取导航 >>> @example API?action=navigations */
    "navigations",

    /** 获取系统设置 >>> @example API?action=options */
    "options",
);


/**
 * 支持请求为 Post 的数据
 */
$api_post_request = array(
    /**
     * 用户登录 - 无验证码
     * @example API?action=login&username={username}&password={password}
     */
    "login",

    /**
     * 用户注册 - 默认作者
     * @param string $type 此参数将作为用户注册类型 默认作者，管理员可增加参数值： $type=root
     * @example API?action=register&name={name}&pass={password}&type={@param $type}
     */
    "register"
);


// Register core Ajax calls.
if (!empty($_GET['action']) && in_array($_GET['action'], $api_get_request, true)) {
    addAction('ep_ajax_' . $_GET['action'], 'ep_ajax_' . str_replace('-', '_', $_GET['action']));
}

if (!empty($_POST['action']) && in_array($_POST['action'], $api_post_request, true)) {
    addAction('ep_ajax_' . $_POST['action'], 'ep_ajax_' . str_replace('-', '_', $_POST['action']));
}

$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';

// 如果不存在此注册函数将返回错误
if (!has_action("ep_ajax_{$action}")) {
    response(array(), "The `{$action}` function does not exist for the current request···", false);
}

print_r($emHooks);
doAction('ep_ajax_' . $action);

die("0");
