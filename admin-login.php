<?php

$admin_email = $admin_password = $email = $password = "";
$admin_email_err = $admin_password_err = $email_err = $password_err = "";
require_once('connect.php');

session_start();
if(isset($_SESSION["adminloggedin"])){
  if($_SESSION["adminloggedin"]==true){
    header("Location:admin-page.php");
  }
}


  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["email"]))){
      $email_err = "Please enter an email.";
    }else{
      $email = trim($_POST["email"]);
    }

    if(empty(trim($_POST["password"]))){
      $password_err = "Please enter your password";
    }else{
      $password = trim($_POST["password"]);
    }

    if(empty(trim($_POST["adminEmail"]))){
      $admin_email_err = "Please enter your email";
    }else{
      $admin_email = trim($_POST["adminEmail"]);
    }

    if(empty(trim($_POST["adminPassword"]))){
      $admin_password_err = "Please enter your password";
    }else{
      $admin_password_err = trim($_POST["adminPassword"]);
    }

    if(empty($email_err) && empty($password_err)){
      $sql = "SELECT * FROM users WHERE email ='$email'";
      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);
      if($count > 0){
        while($row = $result->fetch_assoc()){
          if($row['password']==md5($password)){
            $_SESSION["UID"] = $row['UID'];
            $_SESSION["firstname"] = $row['firstname'];
            $_SESSION["lastname"] = $row['lastname'];
            $_SESSION["adminloggedin"] = true;
          }else{
            $password_err = "Password is wrong";
          }
        }

      }else{
        $login_err = "Invalid Account";
      }
      header("Location:admin-login.php");
    }elseif(empty($admin_email_err) && empty($admin_password_err)){
      $sql = "SELECT * FROM admin WHERE email='$admin_email'";
      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);
      if($count>0){
        while($row=$result->fetch_assoc()){
          if($row['password']==md5($admin_password)){
            $_SESSION["adminID"] = $row['adminID'];
            $_SESSION["firstname"] = $row['firstname'];
            $_SESSION["lastname"] = $row['lastname'];
            $_SESSION["loggedin"] = true;
          }

        }
      }else{
        $login_err = "Invalid Account";
      }
      header("Location:admin-login.php");
    }

  }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>VınVın-Admin Login</title>
  </head>
  <body>
      <!--Navbar-->
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
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 account ">
                <li class="nav-item">
                    <div class="btn text-white" onclick="popUpLogin()">Login</div>
                    <div class="dropdown-menu action-form" id="loginWindow">
                      <div class="container text-center">
                        <p class="mt-3">Login as Admin</p>
                        <input type="button" value="Admin" class="btn btn-outline-success" onclick="relocate_Admin()">
                      </div>
                      <form action="#" method="post">
                
                        <div class="text-center mt-3"><b>or</b></div>
                        <div class="form-group my-3 mx-3">
                          <input type="email" class="form-control" placeholder="Email" required="required" name="email" id="email">
                        </div>
                        <div class="form-group mb-3 mx-3">
                          <input type="password" class="form-control" placeholder="Password" required="required" name="password" id="password">
                        </div>
                        <div class="mb-3 ms-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Keep Signed In</label>
                          </div>
                        <div class="form-group float-start mb-3 mx-3">
                          <a href="cars.php" class="btn">Forgot Password?</a>
                        </div>
                        <div class="form-group float-end mb-3 me-3">
                          <input type="submit" class="btn btn-outline-warning btn-success  btn-block" value="Login">
                        </div>
                      </form>
                    </div>
                  </li>
                <li class="nav-item">
                    <div class="btn text-white">Sign Up</div>
                </li>
            </ul>
          </div>
        </div>
    </nav>

    <!--Login-->

    <div class="container mt-5">
        <h3 class="text-center my-3">Admin Login</h3>
        <div class="row mt-5">
            <div class="col-sm-10 offset-1">
                <div class="col-sm-8 offset-2 bg-white">
                    <form method="" class="" action="admin-page.php">
                        <div class="mb-3">
                          <label for="adminEmail" class="form-label">Email address</label>
                          <input type="email" class="form-control" id="adminEmail" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                          <label for="adminPassword" class="form-label">Password</label>
                          <input type="password" class="form-control" id="adminPassword">   
                        </div>
                        <div class="mb-3 form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Keep Signed In</label>
                        </div>
                        <div>
                        <button type="submit" class="btn btn-success float-end ">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!--Footer-->
    <div class="container fixed-bottom">
        <footer class=" d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
          <p class="col-md-4 mb-0 text-muted">© 2021 Company, Inc</p>
          <a href="main.php">
          <img src="/images/car.png" width="40px" height="40px" alt="">
        </a>
          <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="main.php" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="cars.php" class="nav-link px-2 text-muted">Cars</a></li>
            <li class="nav-item"><a href="contact.php" class="nav-link px-2 text-muted">FAQs</a></li>
            <li class="nav-item"><a href="contact.php" class="nav-link px-2 text-muted">About</a></li>
          </ul>
        </footer>
      </div>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="admin-login.js"></script>
 
  </body>
</html>