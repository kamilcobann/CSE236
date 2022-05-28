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
            $_SESSION["email"]=$row['email'];
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

<?php
### DATETIME CHECK ###
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

    <title>VınVın | MainPage</title>
  </head>
  <body>
    <!-- Navbar -->
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
    <!-- Carousel -->
    <div class="container mb-3">
        <div class="row">
            <div style="padding:0px">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" >
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="https://www.habertekno.com/wp-content/uploads/2021/12/CITROEN-C-Elysee-Fiyati-Bir-Anda-Yuzde-10-Dustu-Iste-C-Elysee-Kampanyali-Satis-Fiyati.jpg" class="d-block w-100" height="500px "alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Economic solutions for your fleet</h5>
                            <p>With fuel efficient cars we can provide you economic cars</p>
                          </div>
                    </div>
                      <div class="carousel-item">
                        <img src="/images/portfolio.jpg" class="d-block w-100" alt="">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Feel the city</h5>
                            <p>Trip the city with our casual cars</p>
                          </div>
                      </div>
                      <div class="carousel-item">
                        <img src="images/portfolio2.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Biggest local rental company</h5>
                            <p>To see our cars please contact us</p>
                          </div>
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
            </div>
        </div>
    </div>
        <!-- Reservation -->
        <div class="container bg-success p-2 text-white mb-3">
            <div class="row">
                
                    <form class="form d-inline-flex row row-cols-3 mt-2" method="POST">
                        
                        <div class="col mb-2">
                        <label class="form-label" for="rentDay">Rent Day:</label>
                        <input type="date" class="form-control" id="rentDay" name="rentDay">
                        </div>
    
                        <div class="col mb-2">
                            <label class="form-label" for="rentTime">Rent Time:</label>
                            <input type="time" class="form-control" id="rentTime" name="rentTime">
                        </div>

                        <div class="col mb-2">
                            <label class="form-label" for="town">Town:</label>
                            <select name="town" class="form-control" id="town">
                                <option value="kaş">Kaş</option>
                                <option value="kemer">Kepez</option>
                                <option value="konyaaltı">Merkez</option>
                                <option value="manavgat">Manavgat</option>
                            </select>
                        </div>
    
                        <div class="col mb-3">
                            <label class="form-label" for="returnDay">Return Day:</label>
                            <input type="date" class="form-control" id="returnDay" name="returnDay">
                            </div>
                        <div class="col mb-3">
                                <label class="form-label" for="returnTime">Rent Time:</label>
                                <input type="time" class="form-control" id="returnTime" name="returnTime">
                        </div>
                        
                        <div class="col mt-4">
                            <button class="btn btn-success btn-outline-warning">Rent a Car</button>
                        </div>
                        


                    </form>
                
            </div>
        </div>
    <!-- Cards -->
    <div class="container">
        <div class="row mainpage-cards">
            <div class="col-sm-10 offset-1 d-flex">

            <div class="card col-sm-3 text-center m-5">
                <img src="images/car-insurance.png" class="p-3" alt="">
                <div class="card-body">
                    <h5>Insuranced cars</h5>
                    <p> If you have an accident that is not your mistake our insurance company will take care of it</p>
                </div>
            </div>

            <div class="card col-sm-3 text-center m-5">
                <img src="images/clean-car.png" class="p-3" alt="">
                <div class="card-body">
                    <h5>Clean cars</h5>
                    <p>Your car will be clean and ready when you pay</p>
                </div>
            </div>

            <div class="card col-sm-3 text-center m-5">
                <img src="images/payment-method.png" class="p-3" alt="">
                <div class="card-body">
                    <h5>Easy Payment</h5>
                    <p>You will only pay the rent price first time. You will pay after you drop off your car to office</p>
                </div>
            </div>
</div>

        </div>

        

    
    </div>

    <!--Footer-->
    <div class="container">
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-muted">© 2021 Company, Inc</p>
        <a href="main.php">
        <img src="images/car.png" width="40px" height="40px" alt="">
      </a>
        <ul class="nav col-md-4 justify-content-end">
          <li class="nav-item"><a href="main.php" class="nav-link px-2 text-muted">Home</a></li>
          <li class="nav-item"><a href="cars.phpmain.php" class="nav-link px-2 text-muted">Cars</a></li>
          <li class="nav-item"><a href="contact.phpmain.php" class="nav-link px-2 text-muted">FAQs</a></li>
          <li class="nav-item"><a href="contact.phpmain.php" class="nav-link px-2 text-muted">About</a></li>
        </ul>
      </footer>
    </div>

      <script src="main.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>