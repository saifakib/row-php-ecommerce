<?php

$site_url = 'http://localhost/php-ecommerce/backend';
require_once '../../app/ssp.class.php';
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'roles';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'id', 'dt' => 0 ),
    array( 'db' => 'name',  'dt' => 1 ),
    array(
        'db'        => 'id',
        'dt'        => 2,
        'formatter' => function( $d, $row ) use($site_url) {
            return 
            '<a href="edit.php?id='.$d.'" class="btn btn-sm btn-info">Edit</a>              
            <a onclick="confirm("Are You Sure ? ")" href="delete.php?id='.$d.'" class="btn btn-sm btn-danger">Delete</a>';
        }
    )
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'php-ecommerce',
    'pass' => 'php-ecommerce-2019',
    'db'   => 'php-ecommerce',
    'host' => 'localhost'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
header('Content-Type: application/json');
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);