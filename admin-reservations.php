<?php
require_once "connect.php";
$firstname = $lastname = $email = $password = $reservationID =  $licence = $gender = $bod = $phone = $isactive =
    "";
$firstname_err = $lastname_err = $email_err = $password_err =$reservationID_err= $licence_err = $gender_err = $bod_err = $phone_err = $uid_err_bl = $uid_err_ac = 
    "";
function validator($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
  if(empty(trim($_POST["resID"]))){
    $reservationID_err = "error";
  }else{
    $reservationID = $_POST["resID"];
  }

  if(empty($reservationID_err)){
    
    $sql = "SELECT * FROM reservations AS r
    INNER JOIN users AS u ON r.userID=u.UID
    INNER JOIN cars AS c ON r.carID=c.carID
    INNER JOIN class AS cl ON c.classID=cl.classID
    WHERE reservationID='$reservationID'
    ";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
      while($row=$result->fetch_assoc()){
        echo "<div class='container'>
          <div class='row'>
          <div class='col-sm-6 offset-3 text-center'>
          RESERVATION DETAILS
          <br>
          Reservation ID :".$row["reservationID"]."
          <br> 
          User ID : ".$row["UID"]."
          <br> 
          User First Name : ".$row["firstname"]."
          <br> 
          User Last Name : ".$row["lastname"]."
          <br> 
          User E-Mail : ".$row["email"]."
          <br> 
          User Licence : ".$row["licence"]."
          <br> 
          User Gender : ".$row["gender"]."
          <br> 
          User BOD : ".$row["birthday"]."
          <br> 
          Car ID: ".$row["carID"]."
          <br> 
          Car Plate: ".$row["plate"]."
          <br> 
          Car Brand : ".$row["carbrand"]."
          <br> 
          Car Model : ".$row["carmodel"]."
          <br> 
          Car Class : ".$row["className"]."
          <br> 
          Car Cost : ".$row["price"]."₺/per day
          <br> 
          Reservation Day and Time : ".$row["reservationDay"]." ".$row["reservationTime"]."
          <br> 
          Return Day and Time : ".$row["returnDay"]." ".$row["returnTime"]."
          <br> 

          </div>
        </div>";
      }
    }
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
                    </tr>
                    </thead>
                <tbody id="table-body">
                <?php
                    $sql = "SELECT * FROM reservations AS r
                    INNER JOIN users AS u ON r.userID=u.UID
                    INNER JOIN cars AS c ON r.carID=c.carID
                    ";
                    $result = $conn->query($sql);

                    if($result->num_rows > 0){
                      while($row=$result->fetch_assoc()){
                        if($row["statement"]==1){
                          $state = "Available";
                        }else{
                          $state = "Not Available";
                        }
                        echo 
                        "<tr><td>".
                        $row["reservationID"].
                        "</td><td>".
                        $row["UID"].
                        "</td><td>".
                        $row["carID"].
                        "</td><td>".
                        $row["reservationDay"].
                        "</td><td>".
                        $row["reservationTime"].
                        "</td><td>".
                        $row["returnDay"].
                        "</td><td>".
                        $row["returnTime"].
                        "</td><td>".
                        $row["cost"].
                        "</td><td></td></tr>";
                      }
                    }
                  ?>
                </tbody>
                </table>




                <div class="row">
                <button type="button" data-bs-toggle="modal" data-bs-target="#detailsModal" class="my-3 col-sm-1 float-sm-end btn btn-outline-info">See Details</button>
                <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="detailsModalLabel">Details</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="" method="POST">
                            <input type="text" name="resID" id="resID" class="form-control my-2" placeholder="Reservation ID">
                          </form>
                        </div>
                        <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                  <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">See details</button>
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