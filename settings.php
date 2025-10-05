<?php
error_reporting(0);
ini_set('display_errors', 0);

define('C_REST_CLIENT_ID', 'local.68e2a59f397144.82091125'); //Application ID
define('C_REST_CLIENT_SECRET', 'KMrL5oI3dGtK5dpOqRGTR16buKxEKPhZgqlyXZvoD2CiQe6XRs'); //Application key

//define('C_REST_WEB_HOOK_TOKEN', '5bxqeukozsla3ipeo576hjf58gkdaget');

define('C_REST_CONTACT_FIELD_XML_ID', 'UF_CRM_COMMUNICATION_LAST_DATETIME');

// or
//define('C_REST_WEB_HOOK_URL','https://rest-api.bitrix24.com/rest/1/doutwqkjxgc3mgc1/');//url on creat Webhook

//define('C_REST_CURRENT_ENCODING','windows-1251');
//define('C_REST_IGNORE_SSL',true);//turn off validate ssl by curl
//define('C_REST_LOG_TYPE_DUMP',true); //logs save var_export for viewing convenience
//define('C_REST_BLOCK_LOG',true);//turn off default logs
//define('C_REST_LOGS_DIR', __DIR__ .'/logs/'); //directory path to save the log
define('C_REST_REDIRECT_URI', 'http://localhost:8080/');