<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
       <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" >

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-0">
                <i class="bi bi-book-fill"></i>
                </div>
                <div class="sidebar-brand-text mx-3">School system</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <?php
            // Add this at the top to get current page name
            $currentPage = basename($_SERVER['PHP_SELF']);
            ?>
            <li class="nav-item <?php echo ($currentPage == 'dashboard.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

          


            <li class="nav-item <?php echo ($currentPage == 'studentsReg.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="studentsReg.php">
                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                    <span>Registration</span></a>
            </li>



            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="bi bi-database-fill-add"></i>
                    <span>Exams</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Classes</h6>
                        <a class="collapse-item" href="studentsReg.php">Form 1</a>
                        <a class="collapse-item" href="utilities-border.html">Form 2</a>
                        <a class="collapse-item" href="utilities-animation.html">Form 3</a>
                        <a class="collapse-item" href="utilities-other.html">Form 4</a>
                    </div>
                </div>
            </li>


             <!-- Nav Item - Utilities Collapse Menu -->
             <li class="nav-item <?php echo ($currentPage == 'payments.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="payments.php">
                <i class="bi bi-wallet-fill"></i>
                    <span>Payments</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>



            
             <!-- Nav Item - Pages Collapse Menu -->
             <li class="nav-item <?php echo ($currentPage == 'getStudentsReport.php') ? 'active' : ''; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="bi bi-file-earmark-break-fill"></i>
                    <span>Reports</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item <?php echo ($currentPage == 'getStudentsReport.php') ? 'active' : ''; ?>" href="getStudentsReport.php">Students Report</a>
                        <a class="collapse-item" href="register.html">Users Report</a>
                        <a class="collapse-item" href="forgot-password.html">Payments Report</a>
                        
                        
                    </div>
                </div>
            </li>



            <!-- Nav Item - Tables -->
            <li class="nav-item ">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            


            <!-- Nav Item - Charts -->


            </li>
              <!-- Nav Item - Tables -->
              <li class="nav-item  <?php echo ($currentPage == 'user.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="user.php">
                <i class="bi bi-people-fill"></i>
                    <span>Users</span></a>
            </li>



             <!-- Nav Item - Charts -->
             <li class="nav-item  <?php echo ($currentPage == 'user_authority.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="user_authority.php">
                <i class="bi bi-gear-fill"></i>
                    <span>Settings</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            

        </ul>