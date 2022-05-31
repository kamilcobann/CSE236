<?php
session_start();

if (isset($_GET["logout"])) {
    session_destroy();
    header("Location:main.php");
}
require_once "connect.php";

$email = $password = $contact_email = $contact_phone = "";
$contact_firstname = $contact_lastname = $contact_message = " ";

$email_err = $password_err = $contact_email_err = $contact_phone_err = "";
$contact_firstname_err = $contact_lastname_err = $contact_message_err = "";
$login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email";
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter an password";
    } else {
        $password = trim($_POST["password"]);
    }

    if ($_SESSION["loggedin"] == false) {
        if (empty(trim($_POST["contactFirstName"]))) {
            $contact_firstname_err = "Please enter your first name";
        } else {
            $contact_firstname = trim($_POST["contactFirstName"]);
        }
    } else {
        $contact_firstname = trim($_POST["contactFirstName"]);
    }

    if ($_SESSION["loggedin"] == true) {
        $contact_lastname = $_SESSION["lastname"];
    } elseif (empty(trim($_POST["contactLastName"]))) {
        $contact_lastname_err = "Please enter your last name";
    } else {
        $contact_lastname = trim($_POST["contactLastName"]);
    }

    if ($_SESSION["loggedin"] == false) {
        if (empty(trim($_POST["contactEmail"]))) {
            $contact_email_err = "Please enter your email";
        } else {
            $contact_email = trim($_POST["contactEmail"]);
        }
    } else {
        $contact_email = $_SESSION["email"];
    }

    if (empty(trim($_POST["contactPhone"]))) {
        $contact_phone_err = "Please enter your phone";
    } else {
        $contact_phone = trim($_POST["contactPhone"]);
    }

    if (empty(trim($_POST["contactMessage"]))) {
        $contact_message_err = "Please enter your message";
    } else {
        $contact_message = trim($_POST["contactMessage"]);
    }

    if (empty($email_err) && empty($password_err)) {
        $sql = "SELECT * FROM users WHERE email ='$email'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row["password"] == md5($password)) {
                    $_SESSION["UID"] = $row["UID"];
                    $_SESSION["firstname"] = $row["firstname"];
                    $_SESSION["lastname"] = $row["lastname"];
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["loggedin"] = true;
                } else {
                    $password_err = "Password is wrong";
                }
            }
        } else {
            $login_err = "Invalid Account";
        }
        header("Location:main.php");
    } elseif (
        empty($contact_firstname_err) &&
        empty($contact_lastname_err) &&
        empty($contact_phone_err) &&
        empty($contact_email_err) &&
        empty($contact_message_err)
    ) {
        $stmt = $conn->prepare(
            "INSERT INTO contact (firstname,lastname,phone,email,message) VALUES (?,?,?,?,?) "
        );
        $stmt->bind_param(
            "sssss",
            $contact_firstname,
            $contact_lastname,
            $contact_phone,
            $contact_email,
            $contact_message
        );
        $stmt->execute();
        $stmt->close();
        header("Location:main.php");
    } else {
        echo "Something went wrong";
    }
}

function validator($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
          <div class="row">
            
            <div class="col-sm-8 mt-5">
              <div class="col-sm-8">
                <h3 class="my-3">FAQ's</h3>
                <div class="accordion" id="accordionExample">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        I'd like to change my reservation. How can I do that?
                      </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        Actions such as changing the car group or adding additional services to your approved reservations cannot be performed through vinvin.com.tr and our mobile website. Guests who wish to make changes to their reservation must contact our call center at 055555555 or our respective office. You can review the VınVın rental agreement document for change rules.
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        How long can I rent for at least? I'll return the car later in the day, how much do I pay?
                      </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        The shortest car rental period is 24 hours. For leases that last less than 1 day (24 hours), the daily rental fee is charged.
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Can I rent a car with points accumulated on my credit card?
                      </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        As VınVın Turkey, we do not have a car rental application with points accumulated on the credit card.
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        How can I cancel my reservation?
                      </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        You can submit your cancellation request by entering your reservation number and email address in the Reservation Cancellation Request tab under the Online Reservation header at the top of VınVın.com.trhome page. You can also cancel your reservation through our call center at 0555555555. Note that if there is is less than 24 hours to the pick-up time of your rental or if the car is not picked up without canceling the reservation, a deduction is applied to the refund of the rental price. For details of cancellation rules, you can review the details of the VınVın Car Rental Agreement.
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-sm-8">
                <h4 class="my-3">Contact Numbers</h4>
                <ul class="list-group list-group-flush bg-transparent my-3">
                  <li class="list-group-item list-group-item-action list-group-item-secondary">Kaş : 055555555555</li>
                  <li class="list-group-item list-group-item-action list-group-item-secondary">Kemer : 06666666666</li>
                  <li class="list-group-item list-group-item-action list-group-item-secondary">Konyaaltı : 02222222222</li>
                  <li class="list-group-item list-group-item-action list-group-item-secondary">Manavgat : 02331654664</li>
                </ul>
              </div>              
              <div class="col-sm-8 my-5">
                <p>
                  You can reach us 24 hours a day, 7 days a week through our VınVın Communication Center line at numbers. You can book a car rental from our Contact Center, reach our roadside assistance line, and send us all your requests, suggestions, opinions and questions that you want to share.
                </p>
              </div>
              <div class="col-sm-8">
                <div style="width: 100%"><iframe scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=500&amp;hl=en&amp;q=Akdeniz%20%C3%9Cniversitesi+(Kamil%20%C3%87oban)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" width="100%" height="500" frameborder="0"><a href="https://www.gps.ie/marine-gps/">ship tracker</a></iframe></div>              </div>
              

            </div>
          <div class="col-sm-4 my-5">
                <div class="container my-3 emailForm">
                  <h3 class="text-center mb-3">Send an Email</h3>
                  <form class="mb-3" method="POST" action="">
                    <label for="contactFirstName" class="form-label mb-3">First Name</label>
                    <input type="text" class="form-control" name="contactFirstName" id="contactFirstName"  <?php if (
                        isset($_SESSION["firstname"])
                    ): ?> value="<?php echo $_SESSION[
     "firstname"
 ]; ?>"<?php endif; ?>>
                    <label for="contactLastName" class="form-label my-3">Last Name</label>
                    <input type="text" class="form-control" name="contactLastName" id="contactLastName" <?php if (
                        isset($_SESSION["lastname"])
                    ): ?> value="<?php echo $_SESSION[
     "lastname"
 ]; ?>"<?php endif; ?>>
                    <label for="contactPhone" class="form-label my-3">Phone Number</label>
                    <input type="tel" class="form-control" name="contactPhone" id="contactPhone">
                    <label for="contactEmail" class="form-label my-3">E-Mail Address</label>
                    <input type="email" class="form-control" name="contactEmail" id="contactEmail" <?php if (
                        isset($_SESSION["email"])
                    ): ?> value="<?php echo $_SESSION[
     "email"
 ]; ?>"<?php endif; ?>>
                    <label for="contactMessage" class="form-label my-3">Message</label>
                    <textarea name="contactMessage" id="contactMessage" cols="3" class="form-control"></textarea>
                    <button class="btn btn-success btn-outline-warning float-end my-3" type="submit">Send</button>

                  </form>
                </div>
              </div>

            </div>

          </div>
        </div>





        <!-- Footer -->
        <div class="container">
          <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-muted">© 2021 Company, Inc</p>
            <a href="main.php">
            <img src="images/car.png" width="40px" height="40px" alt="">
          </a>
            <ul class="nav col-md-4 justify-content-end">
              <li class="nav-item"><a href="main.php" class="nav-link px-2 text-muted">Home</a></li>
              <li class="nav-item"><a href="cars.php" class="nav-link px-2 text-muted">Cars</a></li>
              <li class="nav-item"><a href="contact.php" class="nav-link px-2 text-muted">FAQs</a></li>
              <li class="nav-item"><a href="contact.php" class="nav-link px-2 text-muted">About</a></li>
            </ul>
          </footer>
        </div>

    <script src="contact.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
  </body>
</html>