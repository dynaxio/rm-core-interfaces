<?php
/**
 * config.php
 *
 * rmCore Interfaces Main Config
 *
 * @category   Core
 * @package    rm-core-interfaces
 * @author     Andreas
 * @copyright  2023 RM Group AG
 * @version    1.0.0
 */

/*
 * Directories & URLS
 */
define('INTERFACES_DIR_TMP',        '/tmp');
define('INTERFACES_DIR_ST_RAW',     __DIR__ . "/sourcetax/raw");
define('INTERFACES_DIR_ST_SQL',     __DIR__ . "/sourcetax/sql");


/*
 * SQL Server Configuration
 */
define('INTERFACES_SQL_SERVER',     '10.10.97.249');
define('INTERFACES_SQL_USERNAME',   'rmcore');
define('INTERFACES_SQL_PASSWORD',   'test');
define('INTERFACES_SQL_DATABASE',   'CORE');


/*
 * SQL Templates
 */
define('INTERFACE_TPLS_ST_INSERT',  'insert-sourcetax-record.sql');
?>