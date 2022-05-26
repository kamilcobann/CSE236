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
                <div class="filterButtons float-sm-start">

                </div>
                <button type="button" data-bs-toggle="modal" data-bs-target="#addModal" onclick="addItem()" class="my-3 float-sm-end btn btn-outline-success">Add</button>
                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="addModalLabel">Add Car</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          I WILL WRITE A FUNCTION
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="button" class="btn btn-success">Add</button>
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
                        <th class="col-sm-1" scope="col">Car ID #</th>
                        <th class="col-sm-3" scope="col">Car Image</th>
                        <th class="col-sm-3" scope="col">Car Model</th>
                        <th class="col-sm-2" scope="col">Car Price</th>
                        <th class="col-sm-1" scope="col">Gas Remaining (%)</th>
                        <th class="col-sm-2" scope="col">Operation</th>
                    </tr>
                </thead>
                <tbody id="table-body">

                </tbody>
                </table>
            </div>
        </div>
    </div>



    
    
    
    <script src="admin-cars.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


  </body>
</html>