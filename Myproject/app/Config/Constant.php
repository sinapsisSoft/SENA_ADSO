
<?php
//VARIABLES CONSTANTES GENERALES

define("BASE_URL","http://localhost/SENA/SENA_ADSO/Myproject/public");
define("PASS","");
define("USER","root");
define("DB","");
define("URL_LOGO","../../assets/icons/logo.png");
//////////////////////////////////////
//VARIABLES CONSTANTES URI

define('URI',$_SERVER['REQUEST_URI']);
define('REQUEST_METHOD', $_SERVER['REQUEST_METHOD']);

//////////////////////////////////////
//VARIABLES CONSTANTES DE RUTAS
define('FOLDER_PATH', '/Myproject');
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('PATH_VIEWS', FOLDER_PATH . '../app/Views/');
define('PATH_CONTROLLERS', '../app/Controllers/');
define('PATH_MODELS', '../app/Models/');
define('PATH_INTERFACE', '../app/System/interface/');
define('PATH_SYSTEM_CORE', '../app/System/core/');
define('PATH_SYSTEM', '../app/System/');
define('HELPER_PATH', '../app/System/helpers/');

//////////////////////////////////////
//VARIABLES CONSTANTES CORE
define('CORE', '../app/System/core/');
define('DEFAULT_CONTROLLER', 'Home');

?>