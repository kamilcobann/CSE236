<?php
session_start();
require_once "connect.php";

if (!isset($_SESSION["loggedin"])) {
    header("Location:main.php");
}elseif(isset($_GET["logout"])){
  session_destroy();
  header('Location:main.php');
}elseif(isset($_GET["cart"])){
  $_SESSION["car"]=$row["carbrand"];
  header('Location:reservation-cart.php');
}


$rent_day = $_SESSION["rentDay"];
$rent_time = $_SESSION["rentTime"];
$return_day = $_SESSION["returnDay"]; 
$return_time = $_SESSION["returnTime"];
$branchID = $_SESSION["town"];
$classID = $_SESSION["segment"]; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>VınVın | Car Selection</title>
  </head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success p-2 text-white fixed-top">
      <div class="container-fluid">
          <a class="navbar-brand icon" href="main.php">
              <img src="images/car.png" alt="" width="60" height="60" class="d-inline-block align-text-top">
            </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item mx-3">
              <a class="nav-link text-white" aria-current="page" href="main.php">VınVın</a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link text-white" href="cars.php">Cars</a>
            </li>
            <li class="nav-item mx-3">
                <a href="contact.php" class="nav-link text-white">Contact</a>
            </li>
            
          </ul>
          <?php if (
              isset($_SESSION["loggedin"]) &&
              $_SESSION["loggedin"] === true
          ) { ?>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 account ">
              <li class="nav-item">
              <a href="main.php?logout" class="mt-2 me-2 btn text-white">Sign out</a>
              </li>
              <li class="nav-item">
                  <p class="mt-3 me-3">User</p>
              </li>
              <li>
              <img
              width="50px"
              height="50px"
                  class="admin-icon mt-2 rounded-circle "
                  src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8dXNlcnxlbnwwfHwwfHw%3D&w=1000&q=80" alt="">
              </li>
              
          </ul>
          <?php } else { ?>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 account ">
              <li class="nav-item">
                  <div class="btn text-white" onclick="popUpLogin()">Login</div>
                  <div class="dropdown-menu action-form" id="loginWindow">
                    <div class="container text-center">
                      <p class="mt-3">Login as Admin</p>
                      <input type="button" value="Admin" class="btn btn-outline-success" onclick="relocate_Admin()">
                    </div>
                    <form method="post">
              
                      <div class="text-center mt-3"><b>or</b></div>
                      <div class="form-group my-3 mx-3">
                        <input type="email" class="form-control" placeholder="Email" required="required" name="email" id="email"
                        <?php echo !empty($email_err)
                            ? "is-invalid"
                            : ""; ?>value="<?php echo $email; ?>" >
                        <span><?php echo $email_err; ?></span>

                      </div>
                      <div class="form-group mb-3 mx-3">
                        <input type="password" class="form-control" placeholder="Password" required="required" name="password" id="password" <?php echo !empty(
                            $password_err
                        )
                            ? "is-invalid"
                            : ""; ?>value="<?php echo $password; ?>" >
                        <span><?php echo $password_err; ?></span>
                      </div>
                      <div class="mb-3 ms-3 form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Keep Signed In</label>
                        </div>
                      <div class="form-group float-start mb-3 mx-3">
                        <a href="cars.phpmain.php" class="btn">Forgot Password?</a>
                      </div>
                      <div class="form-group float-end mb-3 me-3">
                        <input type="submit" class="btn btn-outline-warning btn-success  btn-block" value="Login">
                      </div>
                    </form>
                  </div>
                </li>
              <li class="nav-item">
                  <div class="btn text-white" onclick="redirectRegister()">Sign Up</div>
              </li>
          </ul>
          <?php } ?>
        </div>
      </div>
</nav>

<div class="container">
  <div class="row mt-3">
    <div class="col-sm-6 offset-3 border rounded-1">
        <div class="row">
          <div class="rent col">
                          <div class="rent-Day my-2">Rent Day : <?= $rent_day ?></div>
                          <div class="rent-Time mb-2">Rent Time : <?= $rent_time?></div>
          </div>
          <div class="return col">
                          <div class="rent-Day my-2">Return Day : <?= $return_day ?></div>
                          <div class="rent-Time mb-2">Return Time : <?= $return_time?></div>
          </div>
        </div>
  </div>
  </div>
</div>
                          <h3 class="text-center mt-2">Select Your Car</h3>
<section class="menu my-5">
          <div class="container mb-5">
          <div class="section-center row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4
          justify-content-center">
  <?php
  $sql = "SELECT * FROM cars AS c
  INNER JOIN class as cl ON c.classID = cl.classID
  INNER JOIN branches as b ON c.branchID = b.branchID
  WHERE (statement='1' AND b.branchID='$branchID' AND c.classID='$classID')";
  $result=$conn->query($sql);

  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){

      echo 
      "<div class='col mb-5'>
      <div class='card h-100'>
        <img src='".$row["imageURL"]."'width='300px' height='200px' class='card-img-top' alt=''>
        <div class='card-body'>
          <h5 class='card-title'>".$row["carbrand"]." ".$row["carmodel"]."</h5>
          <p class='card-text'>Segment : ".$row["className"]."<br>Now In : ".$row["branchname"]."<br>Plate : ".$row["plate"]."</p>
          <h6>Price : ".$row["price"]." ₺/per day</h6>
          <a href='reservation-cars.php?cart' class='btn btn-primary'>Select</a>
        </div>
      </div></div>";
    }
  }else{
    echo "Sorry :( We do not have the cars that you've been looking for.";
  }

  ?>

  </div>
  </div>
</section>

  </body>

  </html>