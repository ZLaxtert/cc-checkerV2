<?php

/*==========> INFO 
 * CODE     : BY ZLAXTERT
 * SCRIPT   : CC CHECKER
 * VERSION  : DEMO
 * TELEGRAM : t.me/zlaxtert
 * BY       : DARKXCODE
 */

$settings = array(
    "mode_proxy" => "off", // on or off
    "proxy_list" => "", // proxy list (ex: proxy.txt)
    "proxy_pwd" => "", // proxy password (ex: username:pass)
);

$mode_proxy = $settings["mode_proxy"];
$proxy_list = $settings["proxy_list"];
$proxy_pwd  = $settings["proxy_pwd"];
// GET SETTINGS
if (strtolower($mode_proxy) == "off") {
    $Proxies = "";
    $proxy_pass = "";
} else {
    $Proxies = GetProxies($proxy_list);
    $proxy_pass = $proxy_pwd;
}
