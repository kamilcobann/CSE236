<?php
session_start();
require_once "connect.php";
if (isset($_GET["adminlogout"])) {
    session_destroy();
    header("Location:main.php");
}

function validator($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
#$target_dir = 'images/carImages/';
#$target_file = $target_dir.basename($_FILES["image"]["name"]);
#$uploadOk = 1;
#$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
#
#if(isset($_POST["submit"])){
#  $check = getimagesize($_FILES["image"]['tmp_name']);
#  if($check!==false){
#    $uploadOk = 1;
#  }else{
#    $uploadOk = 0;
#  }
#}

$brand = $model = $class = $branch =$carid = $statement = $plate = $image = $available =  "";
$err = $brand_err = $model_err = $class_err = $branch_err = $available_err  = $statement_err = $plate_err = $image_err =$carid_err_bl = $carid_err_ac =
    "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        if (empty(trim($_POST["brand"]))) {
            $brand_err = "Brand cannot be empty";
        } else {
            $brand = validator($_POST["brand"]);
        }

        if (empty(trim($_POST["model"]))) {
            $model_err = "Model cannot be empty";
        } else {
            $model = validator($_POST["model"]);
        }

        
        if (empty(trim($_POST["activateCarID"]))) {
            $carid_err_ac = "Model cannot be empty";
        } else {
            $carid = validator($_POST["activateCarID"]);
        }

        if (empty(trim($_POST["blockCarID"]))) {
            $carid_err_bl = "Model cannot be empty";
        } else {
            $carid = validator($_POST["blockCarID"]);
        }

        $class = $_POST["class"];
        switch ($class) {
            case "B-seg":
                $class = 1;
                break;
            case "C-seg":
                $class = 2;
                break;
            case "SUV":
                $class = 3;
                break;
            case "S-seg":
                $class = 4;
                break;
        }
        $branch = $_POST["branch"];
        switch ($branch) {
            case "merkez":
                $branch = 1;
                break;
            case "kaş":
                $branch = 2;
                break;
            case "kepez":
                $branch = 3;
                break;
            case "manavgat":
                $branch = 4;
                break;
        }

        if ($_POST["statement"] == "available") {
            $statement = "1";
        } else {
            $statement = "0";
        }

        if (empty(trim($_POST["plate"]))) {
            $plate_err = "Plate cannot be empty";
        } else {
            $plate = validator($_POST["plate"]);
        }

        if (empty(trim($_POST["image"]))) {
            $image_err = "Please add image URL";
        } else {
            $image = $_POST["image"];
        }

        $sql = "SELECT plate FROM cars WHERE plate='$plate'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            $plate_err = "Plate exists";
            $conn->close();
        }

        if (
            empty($brand_err) &&
            empty($model_err) &&
            empty($plate_err) &&
            empty($image_err)
        ) {
            $stmt = $conn->prepare("INSERT INTO cars(carbrand,carmodel,classID,
    branchID,statement,plate,imageURL) VALUES (?,?,?,?,?,?,?)");
            $stmt->bind_param(
                "ssiiiss",
                $brand,
                $model,
                $class,
                $branch,
                $statement,
                $plate,
                $image
            );
            $stmt->execute();
            $stmt->close();
            $conn->close();
            $_SESSION["formerr"] = "";
            header("Location:admin-page.php");
        }elseif(empty($carid_err_ac)){
            $sql = "UPDATE cars SET statement='1' WHERE carID='$carid'";
            $result=$conn->query($sql);
            header("Location:admin-cars.php");
        }elseif(empty($carid_err_bl)){
            $sql = "UPDATE cars SET statement='0' WHERE carID='$carid'";
            $result=$conn->query($sql);
            header("Location:admin-cars.php");
        }
        else {
            $_SESSION["formerr"] = "Wrong or Missing information";
            $_SESSION["brandError"] = $brand_err;
            $_SESSION["modelError"] = $model_err;
            $_SESSION["plateError"] = $plate_err;
            $_SESSION["imageError"] = $image_err;
            header("Location:admin-cars.php");
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
        <div class="row d-sm-flex">
            <div class="col-sm-10 offset-1">
                <div class="filterButtons float-sm-start">

                </div>
                <button type="button" data-bs-toggle="modal" data-bs-target="#addModal" class="my-3 float-sm-end btn btn-outline-success">Add</button>
                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="addModalLabel">Add Car </h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="" method="post">
                            <div class="my-2">
                              <label for="brand" class="form-label">Car Brand : <?php if (
                                  !empty($_SESSION["brandError"])
                              ) {
                                  echo '<span class="text-danger">' .
                                      $_SESSION["brandError"] .
                                      "</span>";
                              } else {
                                  echo "";
                              } ?></label>
                              <input type="text" class="form-control" name="brand" id="brand" value="<?= $brand ?>">
                            </div>
                            <div class="mb-2">
                              <label for="model" class="form-label">Car Model : <?php if (
                                  !empty($_SESSION["modelError"])
                              ) {
                                  echo '<span class="text-danger">' .
                                      $_SESSION["modelError"] .
                                      "</span>";
                              } else {
                                  echo "";
                              } ?></label>
                              <input type="text" class="form-control" name="model" id="model" value="<?= $model ?>">
                            </div>
                            <div class="mb-2">
                            <label class="form-label" for="class">Car Class </label>
                            <select name="class" class="form-control" id="class">
                                <option value="B-seg">B-Segment</option>
                                <option value="C-seg">C-Segment</option>
                                <option value="SUV">SUV</option>
                                <option value="S-seg">S-Segment</option>
                            </select>
                            </div>
                            <div class="mb-2">
                            <label class="form-label" for="branch">Branch </label>
                            <select name="branch" class="form-control" id="branch">
                                <option value="kaş">Kaş</option>
                                <option value="kepez">Kepez</option>
                                <option value="merkez">Merkez</option>
                                <option value="manavgat">Manavgat</option>
                            </select>
                            </div>
                            <div class="mb-2">
                              <label for="statement" class="form-label">Statement</label>
                              <select name="statement" id="statement" class="form-control">
                                <option value="available">Available</option>
                                <option value="not-available">Not Available</option>
                              </select>
                            </div>
                            <div class="mb-2">
                              <label for="plate" class="form-label">Plate : <?php if (
                                  !empty($_SESSION["plateError"])
                              ) {
                                  echo '<span class="text-danger">' .
                                      $_SESSION["plateError"] .
                                      "</span>";
                              } else {
                                  echo "";
                              } ?></label>
                              <input type="text" class="form-control" name="plate" id="plate">
                            </div>
                            <div class="mb-2">
                              <label for="image" class="form-label">Add Image URL : <?php if (
                                  !empty($_SESSION["imageError"])
                              ) {
                                  echo '<span class="text-danger">' .
                                      $_SESSION["imageError"] .
                                      "</span>";
                              } else {
                                  echo "";
                              } ?></label>
                              <input type="text" name="image" class="form-control" id="image" >
                              </div>
                              <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <input type="submit" class="btn btn-success" name="addCar" value="Add">
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
                        <th class="col" scope="col">Car ID #</th>
                        <th class="col" scope="col">Car Image</th>
                        <th class="col" scope="col">Car Brand</th>
                        <th class="col" scope="col">Car Model</th>
                        <th class="col" scope="col">Class</th>
                        <th class="col" scope="col">Plate</th>
                        <th class="col" scope="col">Branch</th>
                        <th class="col" scope="col">Statement</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                              <?php
                                $sql = "SELECT * FROM cars";
                                $result=$conn->query($sql);
                                if($result->num_rows >0){
                                    while($row = $result->fetch_assoc()){
                                        if($row["statement"] == 0){
                                            $available = "Not Available";
                                        }else{
                                            $available = "Available";
                                        }

                                        switch ($row["branchID"]) {
                                            case 1:
                                                $town = "MERKEZ";
                                                break;
                                            case 2:
                                                $town = "KAŞ";
                                                break;
                                            case 3:
                                                $town = "KEPEZ";
                                                break;
                                            case 4:
                                                $town = "MANAVGAT";
                                                break;
                                        }

                                        switch ($row["classID"]) {
                                            case 1:
                                                $seg = "B-Segment";
                                                break;
                                            case 2:
                                                $seg = "C-Segment";
                                                break;
                                            case 3:
                                                $seg = "SUV";
                                                break;
                                            case 4:
                                                $seg = "S-Segment";
                                                break;
                                        }

                                        echo "<tr><td>" .
                                        $row["carID"]   .
                                        "</td><td><img src='" .
                                        $row["imageURL"]."'
                                        width='120px' height='100px'  alt='Image'>
                                        </td><td>".
                                        $row["carbrand"]   .
                                        "</td><td>".
                                        $row["carmodel"]   .
                                        "</td><td>".
                                        $seg  .
                                        "</td><td>".
                                        $row["plate"]   .
                                        "</td><td>".
                                        $town  .
                                        "</td><td>".
                                        $available   .
                                        "</td></tr>";
                                           
                                    }
                                }
                              ?>
                </tbody>
                </table>
                <div class="row">
                <button type="button" data-bs-toggle="modal" data-bs-target="#blockModal" class="my-3 col-sm-1 float-sm-end btn btn-outline-danger">Deactivate</button>
                <div class="modal fade" id="blockModal" tabindex="-1" aria-labelledby="blockModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="blockModalLabel">Deactivate Car</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="" method="POST">
                            <input type="text" name="blockCarID" id="blockCarID" class="form-control my-2" placeholder="Car ID">
                          </form>
                        </div>
                        <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-outline-danger" name="deactivate">Deactivate</button>
                                </div>

                      </div>
                    </div>
                  </div>
                  <button type="button" data-bs-toggle="modal" data-bs-target="#activateModal" class="my-3 ms-2 col-sm-1 float-sm-start btn btn-outline-success">Activate</button>
                <div class="modal fade" id="activateModal" tabindex="-1" aria-labelledby="activateModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="activateModalLabel">Activate Car</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="" method="POST">
                            <input type="text" name="activateCarID" id="activateCarID" class="form-control my-2" placeholder="Car ID">
                          </form>
                        </div>
                        <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-outline-success" name="activate">Activate</button>
                                </div>

                      </div>
                    </div>
                  </div>
              </div>
            </div>
        </div>
    </div>



    
    
    
    <script src="admin-cars.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


  </body>
</html>