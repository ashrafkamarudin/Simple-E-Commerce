    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#"><img class="logo" src="../qusoc.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="../home">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
          </ul>
          <div class="my-2 my-lg-0">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="../cart"> Shopping Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i>
              </a>
            </li>
            <li class="nav-item">
              <?php if ($login->isUserLoggedIn() == true) :?>
                <div class="dropdown show">
                  <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hello <?php echo $_SESSION['user_name']; ?>
                  </a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="../cart">View Cart</a>
                    <a class="dropdown-item" href="#">Check Out</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../auth.php?logout" >Log out</a>
                  </div>
                </div>
              <?php else: ?>
                <button type="button" class="btn btn-primary my-2 my-sm-0" data-toggle="modal" data-target="#loginModal"> Login </button>
              <?php endif; ?>
            </li>
          </ul>
          </div>
        </div>
      </div>
    </nav>