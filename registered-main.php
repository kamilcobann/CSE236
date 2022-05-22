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
            <a class="navbar-brand icon" href="registered-main.html">
                <img src="images/car.png" alt="" width="60" height="60" class="d-inline-block align-text-top">
              </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item mx-3">
                <a class="nav-link text-white" aria-current="page" href="registered-main.html">VınVın</a>
              </li>
              <li class="nav-item mx-3">
                <a class="nav-link text-white" href="registered-cars.html">Cars</a>
              </li>
              <li class="nav-item mx-3">
                  <a href="registered-contact.html" class="nav-link text-white">Contact</a>
              </li>
              
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 account ">
              <li class="nav-item">
                  <a href="main.html" class="mt-2 me-2 btn text-white">Sign out</a>
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
                
                    <form class="form d-inline-flex row row-cols-3 mt-2">
                        
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
                                <option value="kemer">Kemer</option>
                                <option value="konyaaltı">Konyaaltı</option>
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
                <img src="/images/car-insurance.png" class="p-3" alt="">
                <div class="card-body">
                    <h5>Insuranced cars</h5>
                    <p> If you have an accident that is not your mistake our insurance company will take care of it</p>
                </div>
            </div>

            <div class="card col-sm-3 text-center m-5">
                <img src="/images/clean-car.png" class="p-3" alt="">
                <div class="card-body">
                    <h5>Clean cars</h5>
                    <p>Your car will be clean and ready when you pay</p>
                </div>
            </div>

            <div class="card col-sm-3 text-center m-5">
                <img src="/images/payment-method.png" class="p-3" alt="">
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

      <script src="main.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>