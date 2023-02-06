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
 * @version    0.2.0
 */


/*
 * Include Third Party & Configs & Classes
 */

// API Main Config
require_once __DIR__ . "/../config.php";

// Composer Autoloader
require_once __DIR__ . "/../vendor/autoload.php";


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

            // Get Record: Canton
            $record_canton = substr($raw_line, 4, 2);

            // Get Record: Tariff
            $record_tariff = substr($raw_line, 6, 1);

            // Get Record: Children
            $record_children = substr($raw_line, 7, 1);

            // Get Record: Chirch Tax
            $record_chirchtax = substr($raw_line, 8, 1);

            // Get Record: Salary (Start)
            $record_salary = intval(substr($raw_line, 24, 9)) / 100;

            // Get Record: Salary (Step)
            $record_salarystep = intval(substr($raw_line, 33, 9)) / 100;

            // Get Record: Minimum Tax
            $record_mintax = intval(substr($raw_line, 45, 9));

            // Get Record: Tax Rate
            $record_taxrate = intval(substr($raw_line, 54, 5)) / 100;

            // Debug Log
            echo("Found Record Type 06 for Canton: " . $record_canton . "\n");

            // Expand Records Array
            $tax_records[] = Array(

                'canton'        => $record_canton,
                'tarif'         => $record_tariff,
                'children'      => $record_children,
                'chirchtax'     => $record_chirchtax,
                'stalary'       => $record_salary,
                'stalarystep'   => $record_salarystep,
                'mintax'        => $record_mintax,
                'taxrate'       => $record_taxrate,

            );

        }

    }
    var_dump($tax_records[250]);

    unset($tax_records);

}

