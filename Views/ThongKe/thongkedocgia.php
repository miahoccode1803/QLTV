<h3>Thống kê độc giả</h3>
<!-- Content Row -->
<div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Số lượng độc giả
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $sldg?></div>
                </div>
                <div class="col-auto">
                    <i class="fa-solid fa-book fa-2x text-gray-300"></i>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Mới trong năm
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $slnew?></div>
                </div>
                <div class="col-auto">
                    
                    <i class="fa-solid fa-user fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Đang hoạt động
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $sldhd?></div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        ngừng hoạt động
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $slnhd?></div>
                </div>
                <div class="col-auto">
                    
                    <i class="fa-solid fa-ban fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<div class="row">

    <div class="col-xl-8 col-lg-7">

        <!-- Area Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Số lượng độc giả đăng ký</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
                <hr>
                <p>Biểu đồ thống kê số lượng độc giả đăng ký mới theo tháng</p>
            </div>
        </div>


    </div>

    <!-- Donut Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Trạng thái độc giả</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4">
                    <canvas id="myPieChart"></canvas>
                </div>
                <hr>
                <p>Biểu đồ thống kê số lượng độc giả đang hoạt động và ngừng hoạt động</p>
            </div>
        </div>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Page level plugins -->
<script src="asset/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="asset/js/demo/chart-area-docgia.js"></script>
<script src="asset/js/demo/chart-pie-docgia.js"></script>






