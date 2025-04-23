<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hệ thống quản lý thư viện THPT Phú Bình</title>

    <!-- Custom fonts for this template-->
    <link href="asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/d69cbc9d77.js" crossorigin="anonymous"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="asset/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="asset/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index?controller=home&action=index">
                <img src="asset/img/logo.png" alt="" class="sidebar-brand-icon " style="width: 40px">
                <div class="sidebar-brand-text mx-1">Thư viện <br> THPT Phú Bình</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index?controller=home&action=index">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Trang chủ</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            

            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=sach&action=index">
                    <i class="fa-solid fa-book"></i>
                    <span>Quản lí sách</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=theloai&action=index">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Quản lí thể loại</span>
                </a>
            </li>

            

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=phieumuon&action=index">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Quản lí mượn trả</span>
                </a>
            </li>
            
            

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Thống kê</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Chức năng</h6>
                        <a class="collapse-item" href="index.php?controller=thongkesach&action=index">Thống kê sách</a>
                        <a class="collapse-item" href="index.php?controller=thongkesach&action=docgia">Thống kê độc giả</a>
                        <a class="collapse-item" href="index.php?controller=thongkesach&action=muontra">Thống kê mượn trả</a>
                    </div>
                </div>
            </li>
            
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=docgia&action=index">
                        <i class="fa-solid fa-users"></i>
                        <span>Quản lí độc giả</span>
                    </a>
            </li>

            <?php 
                if ($_SESSION['user']['LoaiTK'] == '1'){
            ?>        
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Nav Item - Charts -->
            <div>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=nhanvien&action=index">
                        <i class="fa-solid fa-landmark"></i>
                        <span>Quản lí nhân viên</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=taikhoan&action=index">
                        <i class="fa-solid fa-user"></i>
                        <span>Quản lí tài khoản</span>
                    </a>
                </li>
            </div>

            <?php } ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Tìm kiếm..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

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
                                            placeholder="Tìm kiếm..." aria-label="Search"
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
                        

                        <!-- Nav Item - Messages -->
                        

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Nhân viên: <?php echo $_SESSION['user']['HoTen']?></span>
                                <img class="img-profile rounded-circle"
                                    src="asset/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Thông tin cá nhân
                                </a>
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div id="content">
                        <?php include $content; ?>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2024 - Group 5</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc muốn đăng xuất</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Đóng">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đăng xuất" để đăng xuất tài khoản ra khỏi hệ thống!</div>
                <form class="modal-footer" action="index.php?controller=home&action=logout" method="post">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Trở lại</button>
                    
                    <input class="btn btn-primary" type="submit" value="Đăng xuất">
                    
                    
                </form>

            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="asset/vendor/jquery/jquery.min.js"></script>
    <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="asset/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="asset/js/sb-admin-2.min.js"></script>

    


    <!-- Page level plugins -->
    <script src="asset/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="asset/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="asset/js/demo/datatables-demo.js"></script>

</body>

</html>