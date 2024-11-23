<?php

    $folderReference="public";
    $controller_url=(empty($_SERVER['HTTPS'])?'http':'https'). "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $controller_url=substr($controller_url,0,strpos($controller_url, $folderReference))."".$folderReference;
    
    $folder_views=str_replace("Config","",__DIR__)."Views";
    $folder_public=$controller_url;

    $folder_views_css= $folder_views."/assets/css/";
    $folder_views_js= $folder_views."/assets/js/";
    $folder_views_assets= $folder_views."/assets/";
    

    define("URL_CONTROLLER",$controller_url);
    define("FOLDER_VIEWS",$folder_views);
    define("FOLDER_VIEWS_CSS",$folder_views_css);
    define("FOLDER_VIEWS_JS",$folder_views_js);
    define("FOLDER_VIEWS_ASSETS",$folder_views_assets);
    define("FOLDER_PUBLIC_ASSETS",$folder_public."/assets");
    define("URL_CONTROLLER_USER",$controller_url."/user/index");
    define("URL_CONTROLLER_ROLE",$controller_url."/role/index");
    define("URL_CONTROLLER_LOGIN",$controller_url."/login/index");
    define("URL_CONTROLLER_HOME",$controller_url."/home/dashboard");

    define("SESSION_APP","user");
 

?>