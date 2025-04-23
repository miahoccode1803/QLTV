


<div class="d-flex justify-content-center ">
    <div class="col-md-8">
        <div class="card shadow mb-6">
            <div class="card-header bg-primary">
                <h3 class="text-white font-weight-bold d-flex justify-content-center align-items-center m-0">Thông tin phiếu mượn</h3>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="mapm" class="control-label col-md-12">Mã phiếu mượn</label>
                    <div class="col-md-12">
                        <input readonly type="text" name="mapm" id="" class="form-control bg-white" value="<?php echo $pm->getMaPM()?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="mapm" class="control-label col-md-12">Mã nhân viên</label>
                    <div class="col-md-12">
                        <input readonly type="text" name="mapm" id="" class="form-control bg-white" value="<?php echo $pm->getMaNV()?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="mapm" class="control-label col-md-12">Mã độc giả</label>
                    <div class="col-md-12">
                        <input readonly type="text" name="mapm" id="" class="form-control bg-white" value="<?php echo $pm->getMaTTV()?>">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="mapm" class="control-label col-md-12">Ngày mượn</label>
                        <div class="col-md-12">
                            <input readonly type="text" name="mapm" id="" class="form-control bg-white" value="<?php echo $pm->getNgayMuon()?>">
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="mapm" class="control-label col-md-12">Ngày trả</label>
                        <div class="col-md-12">
                            <input readonly type="text" name="mapm" id="" class="form-control bg-white" value="<?php echo $pm->getNgayTra()?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="mapm" class="control-label col-md-12">Lựa chọn</label>
                    <div class="col-md-12">
                        <input readonly type="text" name="mapm" id="" class="form-control bg-white" value="<?php echo $pm->getLuaChon()?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="mapm" class="control-label col-md-12">Trạng thái</label>
                    <div class="col-md-12">
                        <input readonly type="text" name="mapm" id="" class="form-control bg-white" value="<?php echo $pm->getTrangThai()?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="m-6">

        </div>
        
        
        <div class="card shadow mb-6" style="margin-top: 10px;">
            <form action="" method="post">
                <div class="form-horizontal">
                    <div class="card-header bg-danger">
                        <h4 class="text-white font-weight-bold d-flex justify-content-center align-items-center m-0">Tạo phiếu phạt</h4>
                    </div>


                    <div class="card-body">
                        
                        

                        <div class="form-group">
                            <label for="taikhoan" class="control-label col-md-12">Lý do</label>
                            <div class="col-md-12">
                                <input type="text" name="lydo" id="" class="form-control">
                            </div>
                        </div>

                        

                        
                        

                        <!--End Form-->
                        <div class="form-group d-flex align-items-center">
                            <div class="col-md-offset-2 col-md-5 text-right">
                                <input type="submit" name="add_pp" value="Thêm" class="btn btn-primary pl-3 pr-3" />
                            </div>

                            <div class="col-md-offset-2 col-md-5 ">
                                <a href="index?controller=phieumuon&action=index" class="btn btn-default h4 pl-3 pr-3">Trở lại</a>
                            </div>
                        </div>


                    </div>





                </div>
            </form>


            
        </div>

        <?php
        foreach ($ct as $ctpm) {
        ?>
            <div class="card shadow mt-4 mb-2">
                <form action="" method="post">
                    <div class="form-horizontal">
                        <div class="card-header bg-warning ">
                            <h4 class="font-weight-bold text-white d-flex justify-content-center align-items-center m-0">Thông tin sách</h4>
                        </div>


                        <div class="card-body">
                            <!--Start form-->
                            <div class="form-group">
                                <label for="TenDS" class="control-label col-md-12">Mã Sách</label>
                                <div class="col-md-12">
                                    <input readonly type="text" name="TenDS" id="" class="form-control bg-white" value="<?php echo $ctpm->getMaSach() ?>">
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="TenTG" class="control-label col-md-12">Tên sách</label>
                                <div class="col-md-12">
                                    <input readonly type="text" name="TenTG" id="" class="form-control bg-white" value="<?php echo $ctpm->getSach()->DauSach->getTenDS() ?>">
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="TenTG" class="control-label col-md-12">Tên tác giả</label>
                                <div class="col-md-12">
                                    <input readonly type="text" name="TenTG" id="" class="form-control bg-white" value="<?php echo $ctpm->getSach()->DauSach->getTenTG() ?>">
                                    
                                </div>
                            </div>


                        </div>

                        

                    </div>
                </form>


                
            </div>


        <?php }?>
        <script src="https://kit.fontawesome.com/d69cbc9d77.js" crossorigin="anonymous"></script>
    </div>
</div>


