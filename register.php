<?php
require_once('connect.php');

$firstname = $lastname = $email = $password = $password_check = $licence = $gender = $bod = "";
$firstname_err  =  $lastname_err = $email_err = $password_err = $password_check_err = $licence_err = $gender_err = $bod_err = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){

  if(empty(trim($_POST["registerFirstName"]))){
    $firstname_err = "Please enter your name";
  }else{
        $firstname = validator($_POST["registerFirstName"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$firstname)) {
      $firstname_err = "Only letters and white space allowed";
    }
  }
  

  if(empty(trim($_POST["registerLastName"]))){
    $lastname_err = "Please enter your last name";
  }else{
    $lastname = validator($_POST["registerLastName"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$lastname)) {
      $lastname_err = "Only letters and white space allowed";
    }
  }

  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($conn,$sql);
  $count = mysqli_num_rows($result);
  if(empty(trim($_POST["registerEmail"]))){
    $email_err = "Please enter your email";
  }else{
    $email = validator($_POST["registerEmail"]);
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $email_err = "Invalid email format";
    }elseif($count>0){
      $email_err = "E-mail exists";
    }
  }

  if(empty(trim($_POST["registerPassword"]))){
    $password_err = "Please enter a password";
  }elseif(strlen(trim($_POST["registerPassword"]))<6){
    $password_err = "Password must be longer than 6 characters";
  }else{
    $password = trim($_POST["registerPassword"]);
  }

  if(empty(trim($_POST["registerPasswordCheck"]))){
    $password_check_err = "Please confirm password";
  }else{
    $password_check = trim($_POST["registerPassword"]);
    if(empty($password_err) && ($password != $password_check)){
      $password_check_err = "Password did not match";
    }
  }

  if(empty(trim($_POST["registerLicence"]))){
    $licence_err = "Please enter your licence";
  }else{
    $licence= validator($_POST["registerLicence"]);
  }

  if(empty($_POST["gender"])){
    $gender_err = "Gender is required";
  }else{
    $gender = validator($_POST["gender"]);
  }

  if(empty($_POST["registerBirth"])){
    $bod_err = "Birthday is required";
  }else{
    $now = date("d.m.y");
    $bday = date_format(date_create($_POST["registerBirth"]),"d.m.y");
    $age = date_diff(date_create($_POST["registerBirth"]),date_create($now));
    if($age->y<18){
      $bod_err = "You must be older than 18";
    }else{
      $bod = $_POST["registerBirth"];
    }
   
  }
  if($age->y <18){
    $bod_err = "You must be older than 18";
  }else{
    $bod = $_POST["registerBirth"];
  }
 


  if(empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($password_err) && empty($password_check_err) &&
  empty($licence_err) && empty($gender_err) && empty($bod_err)){

    $stmt = $conn->prepare("INSERT INTO users (firstname,lastname,email,password,licence,gender,birthday) VALUES(?,?,?,?,?,?,?)");
    $md5 = md5($password);
    $stmt->bind_param("sssssss",$firstname,$lastname,$email,$md5,$licence,$gender,$bod);
    $stmt->execute();
    $stmt->close();
    header("Location:main.php");
  }else{
    echo "something went wrong";
  }

}

function validator($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>

    <!--Navbar-->
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
              <a class="nav-link text-white" aria-current="page" href="main.html">VınVın</a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link text-white" href="cars.html">Cars</a>
            </li>
            <li class="nav-item mx-3">
                <a href="contact.html" class="nav-link text-white">Contact</a>
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
        </div>
      </div>
  </nav>


    <div class="container mt-4">
      <div class="row">
        <div class="col-sm-6 offset-3 bg-opacity-75 bg-gradient bg-success p-5">
          <h1 class="text-center">Register</h1>
          <form method="post">
            <div class="my-3">
              <label for="registerFirstName" class="form-label">First Name</label>
              <input type="text" name="registerFirstName" id="registerFirstName" class="form-control" 
              <?php echo(!empty($firstname_err)) ? 'is-invalid' : '' ?> value="<?php echo $firstname?>">
              <span><?php echo $firstname_err; ?></span>
            </div>
            <div class="mb-3">
              <label for="registerLastName" class="form-label">Last Name</label>
              <input type="text" name="registerLastName" id="registerLastName" class="form-control"
              <?php echo(!empty($lastname_err)) ? 'is-invalid' : '' ?> value="<?php echo $lastname?>">
              <span><?php echo $lastname_err; ?></span>
            </div>
            <div class="mb-3">
              <label for="registerEmail" class="form-label">Email Address</label>
              <input type="email" name="registerEmail" id="registerEmail" class="form-control"
              <?php echo(!empty($email_err)) ? 'is-invalid' : '' ?> value="<?php echo $email?>">
              <span><?php echo $email_err; ?></span>
            </div>
            <div class="mb-3">
              <label for="registerPassword" class="form-label">Password</label>
              <input type="password" name="registerPassword" id="registerPassword" class="form-control">
            </div>
            <div class="mb-3">
              <label for="registerPasswordCheck " class="form-label">Password Check</label>
              <input type="password" name="registerPasswordCheck" id="registerPasswordCheck" class="form-control">
            </div>
            <div class="mb-3">
              <label for="registerLicence " class="form-label">Driving Licence</label>
              <input type="text" name="registerLicence" id="registerLicence" class="form-control"
              <?php echo(!empty($licence_err)) ? 'is-invalid' : '' ?> value="<?php echo $licence?>">
              <span><?php echo $licence_err; ?></span>
            </div>
            <div class="mb-3">
              Gender
              <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id="male" value="male">
              <label class="form-check-label" for="gender">
                Male
              </label>
              </div>
              <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id="female" value="female">
              <label class="form-check-label" for="gender">
                Female
              </label>
              </div>
              <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id="other" value="other">
              <label class="form-check-label" for="gender">
                Other
              </label>
              </div>
            </div>
            <div class="mb-3">
              <label for="registerBirth" class="form-label">Birth of Date</label>
              <input type="date" name="registerBirth" id="registerBirth" class="form-control"
              <?php echo(!empty($bod_err)) ? 'is-invalid' : '' ?> value="<?php echo $bod?>">
              <span><?php echo $bod_err; ?></span>
            </div>
            <input type="submit" class="btn btn-outline-warning btn-success btn-block float-end" value="Sign Up">


          </form>
        </div>
      </div>
    </div>

    <div class="container">
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-muted">© 2021 Company, Inc</p>
        <a href="main.html">
        <img src="/images/car.png" width="40px" height="40px" alt="">
      </a>
        <ul class="nav col-md-4 justify-content-end">
          <li class="nav-item"><a href="main.html" class="nav-link px-2 text-muted">Home</a></li>
          <li class="nav-item"><a href="cars.html" class="nav-link px-2 text-muted">Cars</a></li>
          <li class="nav-item"><a href="contact.html" class="nav-link px-2 text-muted">FAQs</a></li>
          <li class="nav-item"><a href="contact.html" class="nav-link px-2 text-muted">About</a></li>
        </ul>
      </footer>
    </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="register.js"></script>

  </body>
</html>