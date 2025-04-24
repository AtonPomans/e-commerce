<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      
        <p class="ms-4 mt-2 font-weight-bold text-white">Admin Dashboard</p>
      
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
      <?php if ($loggedIn): ?>
        <li class="nav-item">
          <a class="nav-link text-white " href="./pages/listings.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">Manage Product Listings</i>
            </div>
            
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="./pages/users.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">Manage Users</i>
            </div>
            
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="./auth/adminRegister.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">Create Admins</i>
            </div>
            
          </a>
        </li>
      <?php else: ?>
        <li class="nav-item">
            <p>Please Log In to View SideBar</p>
        </li>
      <?php endif; ?>
      </ul>
      
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        
      </div>
    </div>
  </aside>