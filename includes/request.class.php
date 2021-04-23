<?php

/**
 * 轻量数据请求管理类获取
 * 
 * @author       MrTang
 * @version      1.0
 * @package      Emlog Pro
 * @subpackage   Emlog Pro API
 * @example      new Request()->param("xxxx");
 * 
 *  $request = new Request();
 *  get : $request->get("xxxx");
 *  post : $request->post("xxxx");
 */

if (!defined('EP_API_Core')) {
    exit('EP_API_Core!');
}

class Request
{

    /**
     * 获取当前请求类型
     */
    public function method()
    {
        if ($this->isGet()) {
            return "Get";
        } elseif ($this->isPost()) {
            return "Post";
        } else {
            return "Get";
        }
    }

    /**
     * 检验当前是否为 Get 请求
     * @return bool
     */
    public function isGet(): bool
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET' ? true : false;
    }

    /**
     * 检验当前是否为 Post 请求
     * @return bool
     */
    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST' ? true : false;
    }


    //设置获取GET参数
    public function get($params)
    {
        $ui = array();
        foreach ($_GET as $key => $value) {
            $ui[$key] = trim($value);
        }
        return $ui[$params];
    }

    //设置获取POST参数
    public function post($params)
    {
        $ui = array();
        foreach ($_POST as $key => $value) {
            $ui[$key] = trim($value);
        }
        return $ui[$params];
    }

    /**
     * 获取当前请求的参数
     * 
     * @access public
     * @param  string|array $name 变量名
     * @return mixed
     */
    public function param($name)
    {
        switch ($this->method()) {
            case "GET":
                return $this->get($name);
                break;
            case "POST":
                return $this->post($name);
                break;
            default:
                return $this->get($name);
                break;
        }
    }
}


$request = new Request();
