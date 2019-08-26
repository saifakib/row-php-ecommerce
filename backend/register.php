<?php

session_start();

require_once '../app/Database.php';

$message = [];
if(isset($_POST['register']))
{

  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  $username = trim($_POST['username']);
  $mobile_number = trim($_POST['mobile_number']);


  $result = $connection->insert('users', [
    'email' => $email,
    'password' => password_hash($password, PASSWORD_BCRYPT),
    'username' => $username,
    'mobile_number' => $mobile_number,
  ]);

  if($result){
    $message['success'] = 'Registation Successfull';
  }
  else{
   $message['warning'] = 'Registation Failed';
  }
  
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/auth.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form action="" method="post" class="form-signin">

      <?php include_once 'partials/message.php' ?>
      
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <input type="email" name="email" class="form-control m-3" placeholder="Email address" required >
     <input type="password" name="password"  class="form-control m-3" placeholder="Password" required>
      <input type="text" name="username" class="form-control m-3" placeholder="User Name" required >
      <input type="text" name="mobile_number" class="form-control m-3" placeholder="Mobile Number" required>
      <button name="register" class="btn btn-lg btn-primary btn-block m-3" type="submit">Register</button>
    </form>
  </body>
</html>
