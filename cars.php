<?php
  session_start();

  if(isset($_GET["logout"])){
    session_destroy();
    header('Location:main.php');
  }
  require_once('connect.php');

  $email = $password = "";
  $email_err = $password_err = $login_err = "";

  if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty(trim($_POST["email"]))){
      $email_err = "Please enter an email";
    }else{
      $email = trim($_POST["email"]);
    }

    if(empty(trim($_POST["password"]))){
      $password_err = "Please enter an password";
    }else{
      $password = trim($_POST["password"]);
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
            $_SESSION["loggedin"] = true;


          }else{
            $password_err = "Password is wrong";

          }
        }
      }else{
        $login_err="Invalid Account";
      }
      header("Location:main.php");
    }
  }
  
?>


<!doctype html>
<html lang="tr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>VınVın | Cars</title>
  </head>
  <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-success p-2 text-white fixed-top">
      <div class="container-fluid">
          <a class="navbar-brand icon" href="main.html">
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
          <?php  if(isset($_SESSION["loggedin"])&& $_SESSION["loggedin"]===true){?>
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
          <?php }else { ?>
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
                        <?php echo (!empty($email_err)) ? 'is-invalid' : ''  ?>value="<?php echo $email?>" >
                        <span><?php echo $email_err; ?></span>

                      </div>
                      <div class="form-group mb-3 mx-3">
                        <input type="password" class="form-control" placeholder="Password" required="required" name="password" id="password" <?php echo (!empty($password_err)) ? 'is-invalid' : ''  ?>value="<?php echo $password?>" >
                        <span><?php echo $password_err; ?></span>
                      </div>
                      <div class="mb-3 ms-3 form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Keep Signed In</label>
                        </div>
                      <div class="form-group float-start mb-3 mx-3">
                        <a href="cars.html" class="btn">Forgot Password?</a>
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

        <!--Cars-Header-->
        <header>
          <div class="container car-header-text text-center  d">
            <h2 class="text-white">VınVın Cars</h3>
            <p class="text-white">Car Rental Solutions for Everyone</p>
          </div>
          <img src="images/car-header.jpg" alt="" srcset="" class="img-fluid car-header">
        </header>
        
        <!-- Cars list -->


        <section class="menu my-5">
          <div class="btn-container text-center mb-3 button-menu ">

          </div>
          <div class="btn-container text-center mb-3 button-menu bg-info">

          </div>
          <div class="container mb-5">
          <div class="section-center row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4
          justify-content-center">


          </div>
        </div>
        </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="cars.js"></script>

    <div class="container">
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-muted">© 2021 Company, Inc</p>
        <a href="main.html">
        <img src="images/car.png" width="40px" height="40px" alt="">
      </a>
        <ul class="nav col-md-4 justify-content-end">
          <li class="nav-item"><a href="main.html" class="nav-link px-2 text-muted">Home</a></li>
          <li class="nav-item"><a href="cars.html" class="nav-link px-2 text-muted">Cars</a></li>
          <li class="nav-item"><a href="contact.html" class="nav-link px-2 text-muted">FAQs</a></li>
          <li class="nav-item"><a href="contact.html" class="nav-link px-2 text-muted">About</a></li>
        </ul>
      </footer>
    </div>
  </body>
</html>