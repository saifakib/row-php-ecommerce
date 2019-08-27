<?php 

require_once '../../app/Database.php';

//deleted id
$id = $_REQUEST['id'];

//try to fet delete id name
$result = $connection->select('roles','*',['id' => $id]);
$result->execute();

$data = $result->fetchAll();

foreach($data as $role){
    $roleName = $role['name'];
}

$message = [];

$result = $connection->delete('roles',$id);
if($result)
{
    $message['success'] = $roleName.' is deleted';
}else{
    $message['warning'] = $roleName.' not deleted';
}

header("location: index.php?$message");

?>