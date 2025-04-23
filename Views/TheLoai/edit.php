


<div class="d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card shadow mb-6 ">
            <form action="" method="post">
                <div class="form-horizontal">
                    <div class="card-header">
                        <h4 class="font-weight-bold text-primary d-flex justify-content-center align-items-center m-0">Biểu mẫu cập nhật thể loại</h4>
                    </div>


                    <div class="card-body">
                        <span class="text-danger"><?php echo $erorr ?></span>
                        <!--Start form-->
                        <input hidden type="text" name="MaTL" id="" class="form-control" value="<?php echo $data->getMaTL();?>">
                        

                        <div class="form-group">
                            <label for="taikhoan" class="control-label col-md-12">Tên thể loại</label>
                            <div class="col-md-12">
                                <input type="text" name="TenTL" id="" class="form-control" value="<?php echo $data->getTenTL();?>">
                                <span class="text-danger"><?php echo $erorr_name ?></span>
                            </div>
                        </div>

                        

                        
                        

                        <!--End Form-->
                        <div class="form-group d-flex align-items-center">
                            <div class="col-md-offset-2 col-md-5 text-right">
                                <input type="submit" name="edit_theloai" value="Cập nhật" class="btn btn-primary pl-3 pr-3" />
                            </div>

                            <div class="col-md-offset-2 col-md-5 ">
                                <a href="index?controller=theloai&action=index" class="btn btn-default h4 pl-3 pr-3">Trở lại</a>
                            </div>
                        </div>


                    </div>





                </div>
            </form>


            <script src="https://kit.fontawesome.com/d69cbc9d77.js" crossorigin="anonymous"></script>
        </div>
    </div>
</div>


