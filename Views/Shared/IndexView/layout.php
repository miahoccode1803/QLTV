<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="form-row card-header m-0">
        <h4 class="font-weight-bold text-primary col-sm-6 mt-1">Danh sách</h4>
                            
            <div class=" col-sm-6 text-right justify-content-center mt-2">
                <i class="fa fa-plus text-primary"></i>
                <a href="<?php echo $addlink;?>" class="font-weight-bold text-primary  text-decoration-none h5">Thêm</a>
            </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php
                include("$index");
            ?>
        </div>
    </div>
</div>