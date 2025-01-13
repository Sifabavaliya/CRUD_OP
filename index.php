<?php
  include 'connection.php';

  $search=$_GET['search'] ?? '';
  $page =$_GET['page'] ?? 1;
  $limit = 5;
  $offset = ($page-1) * $limit;

  $sql_count = "SELECT COUNT(*) AS total FROM User_information WHERE name LIKE '%$search%' ";
  $result_count = $con ->query($sql_count);
  $total = $result_count -> fetch_assoc()['total'];
  $totalpages=ceil($total/$limit);

  $sql = "SELECT * FROM user_information WHERE name LIKE '%$search%' LIMIT $offset, $limit";
  $result = $con -> query($sql);

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CRUD</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="./assets/css/style.css" />
  </head>
  <body>
    <div class="heading">
      <h1>PHP CRUD Application Using jQuery Ajax</h1>
    </div>
    <?php
      if( isset ( $_GET ['is_insert'] ) ){
      ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your record has been recorded successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php
        }elseif (isset ($_GET ['is_update'] ) ){
       ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your record has been Updated successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
     <?php 
       }elseif (isset ($_GET ['is_delete'] ) ){
      ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your record has been Deleted successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php
       }else{
        echo "";
       }
      ?>
    <div class="container">
      <div class="wrapper">
        <div class="link">
          <button type="button" class="btn btn-primary">
            <a href="add.php">Add User</a>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
              <path
                fill="white"
                d="M399 384.2C376.9 345.8 335.4 320 288 320l-64 0c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z" />
            </svg>
          </button>
        </div>
        <div class="search-wrapper">
          <form action="">
            <div class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                  fill="black"
                  d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
              </svg>
            </div>
            <input
              class="form-control"
              list="datalistOptions"
              id="exampleDataList"
              name= 'search'
              placeholder="Search..." />
          </form>
        </div>
      </div>
      <div class="display-container">
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Phone No</th>
              <th scope="col" colspan="3">oprations</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($row = $result -> fetch_assoc()){

            ?>
            <tr>
              <td scope="row"><?php echo $row['id'];?></td>
              <td scope="row"><?php echo $row['name'];?></td>
              <td scope="row"><?php echo $row['email'];?></td>
              <td scope="row"><?php echo $row['phone'];?></td>
              <td scope="row">
                <a class='btn btn-success'
                  role='button'
                  href='view.php?id=<?php echo $row['id']; ?>'>
                  <svg
                    xmlns='http://www.w3.org/2000/svg'
                    viewBox='0 0 576 512'>
                    <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                     fill='white' d='M512 80c8.8 0 16 7.2 16 16l0 320c0 8.8-7.2 16-16 16L64 432c-8.8 0-16-7.2-16-16L48 96c0-8.8 7.2-16 16-16l448 0zM64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zM208 256a64 64 0 1 0 0-128 64 64 0 1 0 0 128zm-32 32c-44.2 0-80 35.8-80 80c0 8.8 7.2 16 16 16l192 0c8.8 0 16-7.2 16-16c0-44.2-35.8-80-80-80l-64 0zM376 144c-13.3 0-24 10.7-24 24s10.7 24 24 24l80 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-80 0zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24l80 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-80 0z' />
                  </svg>
                </a>
                <a class='btn btn-warning' role='button' href='add.php?id=<?php echo $row['id']; ?>'>
                  <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'>
                    <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                     fill='black'  d='M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152L0 424c0 48.6 39.4 88 88 88l272 0c48.6 0 88-39.4 88-88l0-112c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 112c0 22.1-17.9 40-40 40L88 464c-22.1 0-40-17.9-40-40l0-272c0-22.1 17.9-40 40-40l112 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L88 64z' />
                  </svg>
                </a>
                <a class='btn btn-danger delete-btn' role='button' id="delete-btn" href="delete.php?id=<?php echo $row['id']?>" onclick="return confirm('ARE YOU SURE You Want To Delete This User?')">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                  <path fill="white" d="M170.5 51.6L151.5 80l145 0-19-28.4c-1.5-2.2-4-3.6-6.7-3.6l-93.7 0c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80 368 80l48 0 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-8 0 0 304c0 44.2-35.8 80-80 80l-224 0c-44.2 0-80-35.8-80-80l0-304-8 0c-13.3 0-24-10.7-24-24S10.7 80 24 80l8 0 48 0 13.8 0 36.7-55.1C140.9 9.4 158.4 0 177.1 0l93.7 0c18.7 0 36.2 9.4 46.6 24.9zM80 128l0 304c0 17.7 14.3 32 32 32l224 0c17.7 0 32-14.3 32-32l0-304L80 128zm80 64l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg>
                </a>
              </td>
            </tr>
            <?php
              }
            ?>
          </tbody>
        </table>
        <div class="pagination">
          <?php if ($page > 1) {
            echo '<a href="?page=' . ($page - 1) . '">Previous</a>';
          }?>
          <?php for ($i = 1; $i <= $totalpages; $i++): ?>
            <a href="?search=<?= $search ?>&page=<?= $i ?>"><?= $i ?></a>        
          <?php endfor; ?>
          <?php
             if ($page < $totalpages) {
             echo '<a href="?page=' . ($page + 1) . '">Next</a>';
           }
          ?>
        </div>
      </div>
    </div>
    <!-- boostrap js -->
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
