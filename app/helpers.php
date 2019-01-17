<?php
/**
 * Created by PhpStorm.
 * User: wang
 * Date: 2019/01/16
 * Time: 15:28
 */
function getHttp(){
    return  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
}
