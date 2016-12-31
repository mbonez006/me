<?php
  define('HTTP_SERVER', 'http://users.aber.ac.uk');
  define('HTTP_CATALOG_SERVER', 'http://users.aber.ac.uk');
  define('HTTPS_CATALOG_SERVER', 'http://users.aber.ac.uk');
  define('ENABLE_SSL_CATALOG', 'false');
  define('DIR_FS_DOCUMENT_ROOT', '/berw/homes1/o/ola/public_html/webshop/catalog/');
  define('DIR_WS_ADMIN', '/ola/webshop/catalog/admin/');
  define('DIR_FS_ADMIN', '/berw/homes1/o/ola/public_html/webshop/catalog/admin/');
  define('DIR_WS_CATALOG', '/ola/webshop/catalog/');
  define('DIR_FS_CATALOG', '/berw/homes1/o/ola/public_html/webshop/catalog/');
  define('DIR_WS_IMAGES', 'images/');
  define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
  define('DIR_WS_CATALOG_IMAGES', DIR_WS_CATALOG . 'images/');
  define('DIR_WS_INCLUDES', 'includes/');
  define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');
  define('DIR_WS_CATALOG_LANGUAGES', DIR_WS_CATALOG . 'includes/languages/');
  define('DIR_FS_CATALOG_LANGUAGES', DIR_FS_CATALOG . 'includes/languages/');
  define('DIR_FS_CATALOG_IMAGES', DIR_FS_CATALOG . 'images/');
  define('DIR_FS_CATALOG_MODULES', DIR_FS_CATALOG . 'includes/modules/');
  define('DIR_FS_BACKUP', DIR_FS_ADMIN . 'backups/');
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
  define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');

  define('DB_SERVER', 'db.dcs.aber.ac.uk');
  define('DB_SERVER_USERNAME', 'ola');
  define('DB_SERVER_PASSWORD', 'sewen006');
  define('DB_DATABASE', 'ola');
  define('USE_PCONNECT', 'false');
  define('STORE_SESSIONS', 'mysql');
  define('CFG_TIME_ZONE', 'Europe/London');
?>