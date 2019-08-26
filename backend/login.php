<?php

session_start();

require_once '../app/Database.php';

$message = [];
if(isset($_POST['login']))
{
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  $result = $connection->select('users','id,email,password',[
      'email' => $email
  ]);

  $result->execute();

  if($result->rowCount() === 1){
      $data = $result->fetch();
      if(password_verify($password, $data['password'])){

        $message['success'] = 'Registation Successfull';
        $_SESSION['logged_in'] = true;
        $_SESSION['email'] = $data['email'];
        $_SESSION['id'] = $data['id'];

        header('location: dashboard.php');

      }
      else{
          $message['warning'] = 'User and password does not match';
      }
  }
  else{
   $message['warning'] = 'User not found';
  }
  
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/auth.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form action="" method="post" class="form-signin">

      <?php include_once 'partials/message.php' ?>
      
      <h1 class="h3 mb-3 font-weight-normal">Login</h1>
      <input type="email" name="email" class="form-control m-3" placeholder="Email address" required >
     <input type="password" name="password"  class="form-control m-3" placeholder="Password" required>
      <button name="login" class="btn btn-lg btn-primary btn-block m-3" type="submit">Login</button>
    </form>
  </body>
</html>
