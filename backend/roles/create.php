<?php 

require_once '../../app/Database.php';

$role = $connection->insert('roles', $_POST);

if($role){
    $data = [
        'message' => 'Role Created'
    ];
}
else{
    $data = [
        'message' => 'Something went Wrong'
    ];
}

header('Content-Type: application/json');
echo json_encode($data);


?>