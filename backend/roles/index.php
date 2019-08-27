<?php 

require_once '../partials/header.php';

$result = $connection->select('roles');
$result->execute();

if($result->rowCount() === 0){
  echo 'data not avialable';
}
else{
  $data = $result->fetchAll();
}
$count = 1;

?>
  
    <div class="container-fluid">
      <div class="row">

          <?php  include_once '../partials/sidebar.php'?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Roles</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button>
            </div>
          </div>

          <form class="form-group" style="width:500px;" action="" method="post">
          <div id="alert" class="alert alert-success" style="display:none">
          </div>
                <input type="text" class="form-control text-center" id="role" placeholder="Role Name">
                <button type="submit" class="form-control btn btn-success my-2" id="rolesubmit">Add Role</button>
          </form>

          <?php
            include_once '../partials/message.php';
          ?>
          <h2>Roles</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>id</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($data as $role) {?> 
                <tr style="font-size:18px;">
                  <td><b><?php echo $count; $count++;?></b></td>
                  <td><?php echo $role['name']; ?></td>
                  <td>
              <!--<a href="<?php echo $site_url;?>/roles/edit.php" class="btn btn-sm btn-info">Edit</a>--> 
                    <a href="edit.php" class="btn btn-sm btn-info">Edit</a>                 
                    <a onclick="confirm('Are You Sure ? ')" href="delete.php?id=<?php echo $role['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                  </td>
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>

    <script>
      let button = document.getElementById('rolesubmit');
          button.addEventListener("click", function(e){
            e.preventDefault();

            const roleName = document.getElementById('role').value;
            
            let http = new XMLHttpRequest();
            let url = 'create.php';
            http.open("POST", url, true);

            http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            http.onreadystatechange = function() { // Call a function when the state changes.
                window.location.href="index.php";
            }
            http.send("Name=" + roleName);

          })
          
    </script>


    <?php require_once '../partials/footer.php' ?>
</body>
</html>