<?php
/**
 * config.php
 *
 * rmCore Interfaces Import: Source Tax
 *
 * @category   Interface/Import
 * @package    rm-core-interfaces
 * @author     Andreas
 * @copyright  2023 RM Group AG
 * @version    0.9.0
 */


/*
 * Include Third Party & Configs & Classes
 */

// API Main Config
require_once __DIR__ . "/../config.php";

// Composer Autoloader
require_once __DIR__ . "/../vendor/autoload.php";


/*
 * Establish Connection to SQL Server
 */
$sql_connection_info = Array(
                            "Database"  =>  INTERFACES_SQL_DATABASE,
                            "UID"       =>  INTERFACES_SQL_USERNAME,
                            "PWD"       =>  INTERFACES_SQL_PASSWORD,
                            "TrustServerCertificate" => 'yes');

$sql_connection = sqlsrv_connect(INTERFACES_SQL_SERVER, $sql_connection_info);


/*
 * Loop through RAW Directory & Collect Files
 */

// Build Array of Files to be imported
$raw_files = Array();
$dir = new DirectoryIterator(dirname(INTERFACES_DIR_ST_RAW . "/*"));
foreach ($dir as $fileinfo) {

    if (!$fileinfo->isDot()) {

        //var_dump($fileinfo->getFilename());
        // Add File to Raw Files Array
        $raw_files[] = INTERFACES_DIR_ST_RAW . "/" . $fileinfo->getFilename();

    }

}

// Debug Log
echo("Found " . sizeof($raw_files) . " RAW Files\n");


/*
 * Process Files
 */

// Loop through Files
foreach($raw_files as $raw_file) {

    // Init Data Array
    $tax_records = Array();

    // Get Records
    $raw_lines = file($raw_file);

    // Loop through Lines
    foreach($raw_lines as $raw_line) {

        // Get Record Type
        $record_type = substr($raw_line, 0, 2);

        // Record Type: 00
        if ($record_type == "00") {

            // Get Record Canton
            $record_canton = substr($raw_line, 2, 2);

            // Debug Log
            echo("Found Record Type 00 for Canton: " . $record_canton . "\n");

        }

        elseif ($record_type == "06") {

            // Record ID
            $record_taxid = trim(substr($raw_line, 0, 9));

            // Get Record: Canton
            $record_canton = substr($raw_line, 4, 2);

            // Get Record: Tariff
            $record_tariff = substr($raw_line, 6, 1);

            // Get Record: Children
            $record_children = substr($raw_line, 7, 1);

            // Get Record: Chirch Tax
            $record_chirchtax = substr($raw_line, 8, 1);

            // Get Record: Valid From
            $record_validfrom = substr($raw_line, 16, 4) . "-" . substr($raw_line, 20, 2) . "-" . substr($raw_line, 22, 2);
            $record_period = substr($record_validfrom, 0, 4);

            // Get Record: Salary (Start)
            $record_salary = intval(substr($raw_line, 24, 9)) / 100;

            // Get Record: Salary (Step)
            $record_salarystep = intval(substr($raw_line, 33, 9)) / 100;

            // Get Record: Minimum Tax
            $record_mintax = intval(substr($raw_line, 45, 9)) / 100;

            // Get Record: Tax Rate
            $record_taxrate = intval(substr($raw_line, 54, 5)) / 100;

            // Debug Log
            echo("Found Record Type 06 for Canton: " . $record_canton . "\n");

            // Expand Records Array
            $tax_record = Array(

                'taxid'         => $record_taxid,
                'period'        => $record_period,
                'validfrom'     => $record_validfrom,
                'canton'        => $record_canton,
                'tariff'        => $record_tariff,
                'children'      => $record_children,
                'chirchtax'     => $record_chirchtax,
                'salary'        => $record_salary,
                'salarystep'    => $record_salarystep,
                'mintax'        => $record_mintax,
                'taxrate'       => $record_taxrate,

            );

            $sql = prepare_sql(INTERFACE_TPLS_ST_INSERT, $tax_record);

            $stmt = sqlsrv_prepare( $sql_connection, $sql );

            if( sqlsrv_execute( $stmt ) === false ) {
                die( print_r( sqlsrv_errors(), true));
            }

        }

    }
    //var_dump($tax_records[250]);

    unset($tax_records);

}


/*
 * Prepare SQL Statement by Template
 */
function prepare_sql($template, $data) {

    /*
     * Read Template Content
     */
    $sql = file_get_contents(INTERFACES_DIR_ST_SQL . "/" . $template);


    /*
     * Replace Values
     */
    foreach($data as $key => $value) {

        $sql = str_replace("%$key%", $value, $sql);

    }


    /*
     * Return Finalized SQL Statement
     */
    return $sql;

}