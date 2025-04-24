 <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-2 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-2 px-3">
        <!--<nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Template</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Template</h6>
        </nav>-->
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <?php if ($loggedIn): ?>
              <div>
                <p>Welcome <?= $curr_admin_user ?> </p>
              </div>
              <p> </p>
              <div>
              <p>
                <a href="./auth/adminLogOut.php">Log Out</a>
              </p>
              </div>

            <?php else: ?>
              
              <a href="./auth/adminLogin.php">Log In</a>
              
            <?php endif; ?>
          </div>
          
        </div>
      </div>
    </nav>
    <!-- End Navbar -->