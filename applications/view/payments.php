<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
 integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

 <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search" />
 <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />





 <?php

include 'header.php';
include 'sidebar.php';

?>

<style>
    .pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding: 10px;
        background-color: #f8f9fc;
        border-radius: 5px;
    }
    
    .pagination span {
        color: #6c757d;
        font-size: 14px;
        font-weight: 500;
    }
    
    .index_buttons {
        display: flex;
        gap: 5px;
    }
    
    .index_buttons button {
        background-color: #fff;
        border: 1px solid #dee2e6;
        color: #4e73df;
        padding: 5px 10px;
        border-radius: 3px;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .index_buttons button:hover {
        background-color: #4e73df;
        color: #fff;
    }
    
    .index_buttons button.active {
        background-color: #4e73df;
        color: #fff;
        border-color: #4e73df;
    }

    .material-symbols-outlined {
    font-variation-settings:
    'FILL' 0,
    'wght' 400,
    'GRAD' 0,
    'opsz' 24
    }

    .search-bar{


    display: flex;
    justify-content: center;
    margin-left: 950px;
    margin-top: 5px;
    align-items: center;

    }
    .search-bar input{
        width: 300px;
        height: 40px;
        border-radius: 10px;
        border-color: 1pxr #4e73df solid;
        border-top-right-radius: 0px; 
        border-bottom-right-radius: 0px;
        outline: none;
        border: none;
        padding: 0 .8rem;
        transition: .2s;
        background-color:rgb(236, 239, 250);
    }
    .search-bar .search-icon{
        width: 40px;
        height: 40px;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        border-style: none;
        background-color: rgb(236, 239, 250);
    }
    .header-bar{
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }
    .header-bar .add{
     margin-left: 30px;
    }

    .buttons{
        position: absolute;
        left: -10px;
    }
   
    
</style>

            <!-- Main Content -->
            <div id="page-content-wrapper" class="w-100">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="../images/profile.jpeg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="../images/profile.jpeg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="../images/profile.jpeg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="../images/profile.jpeg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hassan saed</span>
                                <img class="img-profile rounded-circle"
                                    src="../images/profile.jpeg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        
                    </div>

                    <div class="row">
 <div class="col-sm-12 mb-4">

    <div class="pc-container">
      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col-md-12">
               
              </div>
              
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row ">
            <div class="col-xl-12">
              <!---<a href="form.php"> --->
               
            </a>   
                  
            <div class="table-responsive">
            <div class="header-bar">
             <div class="buttons">   
            <button type="button" class="btn btn-primary btn-sm  add" id="addPayment"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Payment</button>
            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Sort by</button>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Separated link</a></li>
            </ul>
            </div>
                
                <div class="search-bar">
                    <input type="search" placeholder="Search Data...">
                    <button class="search-icon" type="submit" ><span class="material-symbols-outlined">search</span></button>
                </div>
            </div>
            </div>
                <table class="table "   id="paymentTable" >
                    <thead>
                        <tr  class=" fst-normal">
                           <th>PaymentID</th>
                           <th>StudentID</th>
                           <th>FeeType</th>
                           <th>Amount_paid</th>
                           <th>Payment_Status</th>
                           <th>BalanceRemain</th>
                           <th>Action</th>
                        </tr>
                        
                    </thead>

                    <tbody>
                      <tr>

                      </tr>


                    </tbody>



                </table>
                </div>

                <div class="pagination">
                    <span>Show 1 to 10 of 60 Enteries</span>
                    <div class="index_buttons">
                    </div>
                </div>
            </div>
        </div>
        




<!---- resgitration Model --->


<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Payments 💳</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       

      <form id="paymentForm"    method="POST"   enctype="multipart/form-data">

      <input type="hidden" name="paymentId" id="paymentId">
      <div class="row">

      <div class="alert alert-success  d-none" role="alert">
  A simple success alert—check it out!
       </div>
       <div class="alert alert-danger   d-none" role="alert">
  A simple danger alert—check it out!
       </div>


      <div class="col-sm-12">
        <div class="form-group">
        <label >StudentID</label>
        <input type="text" name="" id="student_ID" class="form-control">
        </div>
        </div>

      <div class="col-sm-12">
        <div class="form-group">
        <label >FeeType</label>
        <input type="text" name="" id="fee_Type" class="form-control">
        </div>
        </div>



        
        <div class="col-sm-12">
        <div class="form-group">
        <label >AmountPaid($)</label>
        <input type="tex" name="" id="amount_Paid" class="form-control">
        </div>
        </div>

        



        <div class="col-sm-12">
        <div class="form-group">
        <label >Payment Status</label>
        <select name="payments" id="payments" class="form-control">
          <option value="">Payment Status</option>
          <option value="paid">paid</option>
          <option value="partiallypaid">partially_paid</option>
        </select>
        </div>
        </div>



        </div>

        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>

      </form>



      
    </div>
  </div>
</div>





<!---- end resgitration Model --->


        <!-- [ Main Content ] end -->
      </div>
    </div>
                            

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>

            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="footer-content py-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="footer-text">
                                        <span class="text-muted">&copy; 2025 All Rights Reserved.</span>
                                    </div>
                                    <div class="footer-dev">
                                        <span class="text-muted">Developed with <i class="fas fa-heart text-danger"></i> by Eng Hassan Saed</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

<?php

include 'footer.php';



?>


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
 integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

 <script src="../js/reg.js"></script>
 <script src="../js/payments.js"></script>
 <script src="../js/pagination.js"></script>

<style>
.footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    background: #fff;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.035);
    z-index: 1030;
}

.footer-content {
    font-size: 0.875rem;
}

.footer-dev i {
    font-size: 0.75rem;
    margin: 0 3px;
}

#page-content-wrapper {
    padding-bottom: 70px;
}

@media (max-width: 768px) {
    .footer-content .d-flex {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
}
</styl>