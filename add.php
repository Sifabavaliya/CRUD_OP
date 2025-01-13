<?php
  include 'connection.php';

  $button_text = "Add User";
  $redirect_url = "index.php";
  $id = ! empty( $_POST['id'] ) ? $_POST['id'] : '';
  $name =  '';
  $email = '';
  $phone =  '';

  if(isset($_GET['id'])){
    $button_text = "Update User";
    $id = $_GET['id'];
    $sql = "SELECT * FROM User_information WHERE id = $id";
    $result = $con -> query($sql);
    $row = $result -> fetch_assoc();
    $name = ! empty( $row['name'] ) ? $row['name'] : '';
    $email = ! empty( $row['email'] ) ? $row['email'] : '';
    $phone = ! empty( $row['phone'] ) ? $row['phone'] : '';
    $redirect_url = "index.php?is_update=true";
  }

  if($_SERVER['REQUEST_METHOD']=="POST"){
    $id = ! empty( $_POST['id'] ) ? $_POST['id'] : '';
    $name = ! empty( $_POST['name'] ) ? $_POST['name'] : '';
    $email = ! empty( $_POST['email'] ) ? $_POST['email'] : '';
    $phone = ! empty( $_POST['phone'] ) ? $_POST['phone'] : '';
  
    if($_GET['id']){
      $sql = "UPDATE `user_information` SET `name`='$name',`email` = '$email',`phone` = '$phone' WHERE `user_information`.`id` = $id";
    }else{
      $sql = "INSERT INTO  User_information (id, name, email, phone) VALUES (NULL, '$name', '$email', '$phone')";
      $redirect_url = "index.php?is_insert=true";
    }

    $result = $con->query($sql);
    
    if($result){
      header("location:./" . $redirect_url); 
    }
    
  }
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add/edit</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="./assets/css/style.css" />
  </head>
  <body>
    <div class="heading">
      <h1>PHP CRUD Application Using jQuary Ajax</h1>
    </div>
    <div class="container">
      <h3>ADD USER</h3>
      <form method="POST">
        <div class="mb-3">
          <label for="name" class="form-label">User Name</label>
          <input
            type="text"
            class="form-control"
            id="name"
            name="name"
            value="<?php echo $name; ?>"
            required />
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input
            type="email"
            class="form-control"
            id="email"
            aria-describedby="emailHelp"
            name="email"
             value="<?php echo $email; ?>"
            required />
          <div id="emailHelp" class="form-text">
            We'll never share your email with anyone else.
          </div>
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Phone No:</label>
          <input
            type="number"
            class="form-control"
            id="phone"
            name="phone"
             value="<?php echo $phone; ?>"
            required />
        </div>
        <?php if ( ! empty( $id ) ) { ?>
          <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <?php } ?>
        <button type="reset" class="btn btn-primary">Reset</button>
        <button
          type="button"
          class="btn btn-primary"
          data-bs-dismiss="modal"
          onclick="location.href='index.php';">
          Cancle
        </button>
        <button type="submit" class="btn btn-primary"><?php echo $button_text ?></button>
      </form>
    </div>
    <!-- boostrap js -->
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
