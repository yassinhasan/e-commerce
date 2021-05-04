<?php

defined("DS") ? null : define("DS",DIRECTORY_SEPARATOR);
defined("CONFIG_PATH") ? null : define("CONFIG_PATH",dirname(realpath(__FILE__)).DS ); //C:\xampp\htdocs\project\app\config\
defined("APP_PATH") ? null : define("APP_PATH",dirname(realpath(__FILE__)).DS."..".DS ); //C:\xampp\htdocs\project\app\config\..\"
defined("OUT_PATH") ? null : define("OUT_PATH",dirname(realpath(__FILE__)).DS."..".DS."..".DS ); //C:\xampp\htdocs\project\app\config\..\"
defined("VIEW_PATH") ? null : define("VIEW_PATH",dirname(realpath(__FILE__)).DS."..".DS."views".DS ); 
defined("CONN_PATH") ? null : define("CONN_PATH",dirname(realpath(__FILE__)).DS."..".DS."lib".DS."connection".DS."connection.php" );//C:\xampp\htdocs\project\app\config\..\views\
defined("TEMP_PATH")? null : define("TEMP_PATH",dirname(realpath(__FILE__)).DS."..".DS."template".DS);
define("CSS", "/css//");
define("JS", "/js//");
defined("LANG_PATH")? null : define("LANG_PATH",dirname(realpath(__FILE__)).DS."..".DS."language".DS);
defined("DEFAULT_LANGUAGE") ? NULL : define("DEFAULT_LANGUAGE", "ar");
// session config
defined("SESSION_NAME") ? NULL : define("SESSION_NAME", "STORE");
defined("SESSION_LIFE_TIME") ? NULL : define("SESSION_LIFE_TIME", 0);
defined("SESSION_SAVE_PATH") ? NULL : define("SESSION_SAVE_PATH", OUT_PATH."session"); //C:\xampp\htdocs\E_commerce\app\config\..\..\session
defined("GENERAL_UPLOADED_PATH")? null : define("GENERAL_UPLOADED_PATH",OUT_PATH . "public" . DS);
defined("UPLOADED_PATH") ? null : define("UPLOADED_PATH", GENERAL_UPLOADED_PATH. "images" . DS);


defined("APP_SALT") ? NULL : define("APP_SALT", '$2a$07$yeNCSNwRpYopOhv0TrrReP$');
defined("EXCLUDED_URL") ? NULL : define("EXCLUDED_URL",array(
    "/homepage/default",
    "/users/profile",
    "/users/changepassword",
    "/auth/login",
    "/notfound/notfound",
    "/accessdenid/default"
));
defined("MAX_UPLOADED_FILE_SIZE") ? NULL : define("MAX_UPLOADED_FILE_SIZE",ini_get("upload_max_filesize"));

