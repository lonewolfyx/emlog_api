<?php
/**
 * Emlog Pro Api >>>> 导航相关数据
 * 
 * @author       MrTango
 * @version      1.0
 * @package      Emlog Pro
 * @subpackage   Emlog Pro Api
 */

function ep_ajax_options(){
    global $CACHE;
    response( $CACHE->readCache("sta") );
}
