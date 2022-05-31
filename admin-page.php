<?php
require_once "connect.php";
session_start();
if (isset($_GET["adminlogout"])) {
    session_destroy();
    header("Location:main.php");
}

$sql_users = "SELECT * FROM users";
$result_users = mysqli_query($conn, $sql_users);
$count_users = mysqli_num_rows($result_users);

$sql_reservations = "SELECT * FROM reservations";
$result_reservations = mysqli_query($conn, $sql_reservations);
$count_reservations = mysqli_num_rows($result_reservations);

$sql_cars = "SELECT * FROM cars";
$result_cars = mysqli_query($conn, $sql_cars);
$count_cars = mysqli_num_rows($result_cars);
?>
<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="admin.css">
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>VınVın | Admin</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success p-2 text-white fixed-bottom">
      <div class="container-fluid">
          <a class="navbar-brand icon" href="admin-page.php">
              <img src="images/car.png" alt="" width="60" height="60" class="d-inline-block align-text-top">
            </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item mx-3">
              <a class="nav-link text-white" href="admin-cars.php">Cars</a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link text-white" href="admin-users.php">Users</a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link text-white" href="admin-reservations.php">Reservations</a>
              </li>

          </ul>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 account ">
              <li class="nav-item">
              <a href="admin-page.php?adminlogout" class="mt-2 me-2 btn text-white">Sign out</a>
              </li>
              <li class="nav-item">
                  <p class="mt-3 me-3">Admin</p>
              </li>
              <li>
              <img
                  class="admin-icon mt-2 rounded-circle "
                  src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8dXNlcnxlbnwwfHwwfHw%3D&w=1000&q=80" alt="">
              </li>
              
          </ul>
        </div>
      </div>
  </nav>


    <div class="container mt-5">
      <div class="row row-cols-2 row-cols-md-3">
        <div class="col">
          <div class="card">
            <div class="card-body text-center">
              <h5 class="card-title ">Number of Users</h5>
              <div>
              <img src="images/graph1.png" height="50px" width="50px" class="float-" alt="...">
              <br>
              <p class=" mt-2 fs-1"><?= $count_users ?></p>
              </div>
              <div class="text-center mt-2">
              <a href="admin-users.php" class="btn btn-primary">Go to Users</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body text-center">
              <h5 class="card-title ">Number of Reservations</h5>
              <div>
              <img src="images/resicon.png" height="50px" width="50px" class="float-" alt="...">
              <br>
              <p class=" mt-2 fs-1"><?= $count_reservations ?></p>
              </div>
              <div class="text-center mt-2">
              <a href="admin-reservations.php" class="btn btn-primary">Go to Reservations</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body text-center">
              <h5 class="card-title ">Number of Cars</h5>
              <div>
              <img src="images/graph3.png" height="50px" width="50px" alt="...">
              <br>
              <p class=" mt-2 fs-1"><?= $count_cars ?></p>
              </div>
              <div class="text-center mt-2">
              <a href="admin-cars.php" class="btn btn-primary">Go to Cars</a>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>

    <div class="container mt-5">
      <div class="row">
        <div class="col">
          <div class="card">
            <h5 class="text-center mt-3">Annual Earnings</h5>
            <div class="card-body">
            <img src="/images/chart.png"  height="800px" alt="">
          </div>
          </div>
        </div>
      </div>
    </div>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


  </body>
</html>