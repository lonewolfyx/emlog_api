<?php

/**
 * Emlog Pro Api 功能函数库
 * 
 * @author       MrTango
 * @version      1.0
 * @package      Emlog Pro
 * @subpackage   Emlog Pro Api
 */

if (!defined('EP_API_Core')) {
    exit('EP_API_Core!');
}

/**
 * 检测是否存有此函数
 * 
 * @param string $args
 * @return bool
 */
function has_action($args)
{
    global $emHooks;

    if (isset($emHooks[$args])) {
        return true;
    }

    return false;
}

/**
 * 判断是否为 xml 请求
 * 
 * @return bool True if `Accepts` or `Content-Type` headers contain `text/xml` or one of the related MIME types. False otherwise.
 */
function is_xml_request()
{
    $accepted = array(
        'text/xml',
        'application/rss+xml',
        'application/atom+xml',
        'application/rdf+xml',
        'text/xml+oembed',
        'application/xml+oembed',
    );

    if (isset($_SERVER['HTTP_ACCEPT'])) {
        foreach ($accepted as $type) {
            if (false !== strpos($_SERVER['HTTP_ACCEPT'], $type)) {
                return true;
            }
        }
    }

    if (isset($_SERVER['CONTENT_TYPE']) && in_array($_SERVER['CONTENT_TYPE'], $accepted, true)) {
        return true;
    }

    return false;
}

/**
 * 输出 json 格式
 * 
 * @param array $data  输出数据数组
 * @param array $msg   错误值内容
 * @param array $type  当前是否存在内容
 * @return array
 * 
 */
function response(array $data, string $msg = '', bool $type = true)
{
    if ($type) {

        print_r(array(
            "status" => "success",
            "result" => $data,
            "author" => array(
                "name"     => "MrTang",
                "website"  => "https://datapi.cn",
                "mail"     => "olddrivero.king@qq.com"
            )
        ));

        die();
    } else {

        print_r(json_encode(array(
            "status" => "error",
            "result" => null,
            "msg"    => $msg,
            "author" => array(
                "name"     => "MrTang",
                "website"  => "https://datapi.cn",
                "mail"     => "olddrivero.king@qq.com"
            )
        ), JSON_UNESCAPED_UNICODE));

        die();
    }
}

/**
 * 载入当前使用模板注入接口参数挂载点
 * 
 * @param string $template 模板文件夹名称
 * @return bool
 */
function getTemplateApiCoreOtions($template)
{
    if (!is_file($optionFile = TPLS_PATH . $template . '/apis.php')) {
        return false;
    }
    include $optionFile;
    if (!isset($options) || !is_array($options)) {
        return false;
    }
    if (strpos(file_get_contents($optionFile), '@support apis_options') !== false) {
        return $options;
    }
    return false;
}

getTemplateApiCoreOtions($CACHE->readCache("options")["nonce_templet"]);
