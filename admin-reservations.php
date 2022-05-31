<?php
require_once "connect.php";
$firstname = $lastname = $email = $password = $licence = $gender = $bod = $phone = $isactive =
    "";
$firstname_err = $lastname_err = $email_err = $password_err = $licence_err = $gender_err = $bod_err = $phone_err = $uid_err_bl = $uid_err_ac = 
    "";
function validator($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["firstname"]))) {
        $firstname_err = "First Name is required";
    } else {
        $firstname = validator($_POST["firstname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
            $firstname_err = "Only letters and white space allowed";
        }
    }

    if (empty(trim($_POST["lastname"]))) {
        $lastname_err = "Last Name is required";
    } else {
        $lastname = validator($_POST["lastname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
            $lastname_err = "Only letters and white space allowed";
        }
    }

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email";
    } else {
        $email = validator($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email format";
        } elseif ($count > 0) {
            $email_err = "E-mail exists";
        }
    }

    $isactive = "1";
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must be longer than 6 characters";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["licence"]))) {
        $licence_err = "Please enter the licence";
    } else {
        $licence = validator($_POST["licence"]);
    }

    if (empty($_POST["gender"])) {
        $gender_err = "Gender is required";
    } else {
        $gender = validator($_POST["gender"]);
    }

    if (empty($_POST["birthday"])) {
        $bod_err = "Birthday is required";
    } else {
        $now = date("d.m.y");
        $age = date_diff(date_create($_POST["birthday"]), date_create($now));
        if ($age->y < 18) {
            $bod_err = "You must be older than 18";
        } else {
            $bod = $_POST["birthday"];
        }
    }

    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Phone required";
    } else {
        $phone = validator($_POST["phone"]);
    }
    if (empty(trim($_POST["blockUID"]))) {
        $uid_err_bl = "UID required";
    } else {
        $uid = validator($_POST["blockUID"]);
    }


    if(empty(trim($_POST["activateUID"]))){
      $uid_err_ac= "UID required";
    }else{
      $uid = validator($_POST["activateUID"]);
    }

    if (
        empty($firstname_err) &&
        empty($lastname_err) &&
        empty($email_err) &&
        empty($password_err) &&
        empty($licence_err) &&
        empty($gender_err) &&
        empty($bod_err) &&
        empty($phone_err)
    ) {
        $stmt = $conn->prepare(
            "INSERT INTO users (firstname,lastname,email,password,licence,gender,birthday,phone,isactive) VALUES(?,?,?,?,?,?,?,?,?)"
        );
        $md5 = md5($password);
        $stmt->bind_param(
            "sssssssss",
            $firstname,
            $lastname,
            $email,
            $md5,
            $licence,
            $gender,
            $bod,
            $phone,
            $isactive
        );
        $stmt->execute();
        $stmt->close();
        header("Location:admin-users.php");
    } elseif (empty($uid_err_bl)) {
        $sql = "UPDATE users SET isactive='0' WHERE UID='$uid'";
        $result = $conn->query($sql);
        header("Location:admin-users.php");
    } elseif(empty($uid_err_ac)) {
      $sql = "UPDATE users SET isactive='1' WHERE UID='$uid'";
      $result = $conn->query($sql);
      header("Location:admin-users.php");
    }else{
      echo "Someting went wrong";
    }
}
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
                    <a href="main.php" class="mt-2 me-2 btn text-white">Sign out</a>
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
        <div class="row d-sm-flex">
            <div class="col-sm-10 offset-1">
                <button type="button" data-bs-toggle="modal" data-bs-target="#addModal" class="my-3 float-sm-end btn btn-outline-success">Add</button>
                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="addModalLabel">Add User</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="" method="POST">
                            <div class="my-3">
                              <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" 
                              <?php echo !empty($firstname_err)
                                  ? "is-invalid"
                                  : ""; ?> value="<?php echo $firstname; ?>">
              <span class="text-danger"><?php echo $firstname_err; ?></span>
                            </div>
                            <div class="mb-3">
                              <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name"
                              <?php echo !empty($lastname_err)
                                  ? "is-invalid"
                                  : ""; ?> value="<?php echo $lastname; ?>">
              <span class="text-danger"><?php echo $lastname_err; ?></span>
                            </div>
                            <div class="mb-3">
                              <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" <?php echo !empty(
                                  $email_err
                              )
                                  ? "is-invalid"
                                  : ""; ?> value="<?php echo $email; ?>">
              <span class="text-danger"><?php echo $email_err; ?></span>
                            </div>
                            <div class="mb-3">
                              <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="mb-3">
                              <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" <?php echo !empty(
                                  $phone_err
                              )
                                  ? "is-invalid"
                                  : ""; ?> value="<?php echo $phone; ?>">
              <span class="text-danger"><?php echo $phone_err; ?></span>
                            </div>
                            <div class="mb-3">
                              <input type="text" name="licence" id="licence" class="form-control" placeholder="Licence"              <?php echo !empty(
                                  $licence_err
                              )
                                  ? "is-invalid"
                                  : ""; ?> value="<?php echo $licence; ?>">
              <span class="text-danger"><?php echo $licence_err; ?></span>
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
                                <label for="birthday" class="form-label">Birth of Date</label>
                                <input type="date" name="birthday" class="form-control" id="birthday"
                                <?php echo !empty($bod_err)
                                    ? "is-invalid"
                                    : ""; ?> value="<?php echo $bod; ?>">
              <span class="text-danger"><?php echo $bod_err; ?></span>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                  <input type="submit" class="btn btn-outline-warning btn-success btn-block float-end" value="Add User">

                                </div>
                              </form>
                        </div>

                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-sm-10 offset-1">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="col" scope="col">Reservation ID #</th>
                        <th class="col" scope="col">User ID #</th>
                        <th class="col" scope="col">Car ID #</th>
                        <th class="col" scope="col">Reservation Day</th>
                        <th class="col" scope="col">Reservation Time</th>
                        <th class="col" scope="col">Return Day</th>
                        <th class="col" scope="col">Return Time</th>
                        <th class="col" scope="col">Cost</th>
                        <th class="col" scope="col">Statement</th>
                    </tr>
                    </thead>
                <tbody id="table-body">
                </tbody>
                </table>

                <div class="row">
                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="my-3 col-sm-1 float-sm-end btn btn-outline-danger">Cancel</button>
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="deleteModalLabel">Block User</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="" method="POST">
                            <input type="text" name="blockUID" id="blockUID" class="form-control my-2" placeholder="User ID">
                          </form>
                        </div>
                        <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-outline-danger" name="block">Block</button>
                                </div>

                      </div>
                    </div>
                  </div>

              </div>

              </div>
            </div>

    </div>
              
        </div>
    </div>

    
    
    <script src="admin-users.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


  </body>
</html>