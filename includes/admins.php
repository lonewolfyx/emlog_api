<?php

/**
 * Emlog Pro Api 数据请求函数库
 * 
 * @author       MrTango
 * @version      1.0
 * @package      Emlog Pro
 * @subpackage   Emlog Pro Api
 */

if (!defined('EP_API_Core')) {
    exit('EP_API_Core!');
}

//define( 'PATH', __DIR__ . '/' );

/** 加载 Emlog 用户注册 API 包 */
require_once 'core/sigins.php';

/** 加载 Emlog 文章涉及 API 包 */
require_once 'core/logs.php';

/** 加载 Emlog 分类 API 包 */
require_once 'core/category.php';

/** 加载 Emlog 标签 API 包 */
require_once 'core/tags.php';

/** 加载 Emlog 评论 API 包 */
require_once 'core/comments.php';

/** 加载 Emlog 链接 API 包 */
require_once 'core/links.php';

/** 加载 Emlog 导航 API 包 */
require_once 'core/navigations.php';

/** 加载 Emlog 设置 API 包 */
require_once 'core/options.php';

/** 加载 Emlog 用户 API 包 */
require_once 'core/users.php';
