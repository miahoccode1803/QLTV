


<div class="d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card shadow mb-6 ">
            <form action="" method="post">
                <div class="form-horizontal">
                    <div class="card-header">
                        <h4 class="font-weight-bold text-primary d-flex justify-content-center align-items-center m-0">Biểu mẫu thêm đầu sách</h4>
                    </div>


                    <div class="card-body">
                        <span class="text-danger"><?php echo $erorr ?></span>
                        <!--Start form-->
                        

                        <div class="form-group">
                            <label for="TenDS" class="control-label col-md-12">Mã sách</label>
                            <div class="col-md-12">
                                <input type="text" name="MaSach" id="" class="form-control">
                                <span class="text-danger"><?php echo $erorr_masach ?></span>
                            </div>
                        </div>
                        <input hidden type="text" name="MaDS" id="" class="form-control" value="<?php echo $dausach->getMaDS();?>">
                        <div class="form-group">
                            <label for="TenDS" class="control-label col-md-12">Đầu sách</label>
                            <div class="col-md-12">
                                <input readonly type="text" name="TenDS" id="" class="form-control" value="<?php echo $dausach->getTenDS();?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="TenDS" class="control-label col-md-12">Trạng thái</label>
                            <div class="col-md-12">
                                <select class="form-control" name="TrangThai" id="">
                                    <option value="1">Đang còn</option>
                                    <option value="0">Đang cho mượn</option>
                                    <option value="2">Mất</option>
                                </select>
                            </div>
                        </div>

                        

                        
                        

                        <!--End Form-->
                        <div class="form-group d-flex align-items-center">
                            <div class="col-md-offset-2 col-md-5 text-right">
                                <input type="submit" name="add_sach" value="Thêm" class="btn btn-primary pl-3 pr-3" />
                            </div>

                            <div class="col-md-offset-2 col-md-5 ">
                                <a href="index?controller=sach&action=index" class="btn btn-default h4 pl-3 pr-3">Trở lại</a>
                            </div>
                        </div>


                    </div>





                </div>
            </form>


            <script src="https://kit.fontawesome.com/d69cbc9d77.js" crossorigin="anonymous"></script>
        </div>
    </div>
</div>


