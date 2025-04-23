<div class="d-flex justify-content-center">
<div class="dl-horizontal col-md-8">
        <div class="card shadow mb-6 ">
            
                <div class="form-horizontal">
                    <div class="card-header">
                        <h4 class="font-weight-bold text-primary d-flex justify-content-center align-items-center m-0">Thông tin đầu phiếu mượn</h4>
                    </div>


                    <div class="card-body">
                        <!--Start form-->
                        <div class="form-group">
                            <label for="TenDS" class="control-label col-md-12">Mã phiếu mượn</label>
                            <div class="col-md-12">
                                <input readonly type="text" name="TenDS" id="" class="form-control bg-white" value="<?php echo $phieumuon->getMaPM() ?>">
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="TenTG" class="control-label col-md-12">Thẻ thư viện</label>
                            <div class="col-md-12">
                                <input readonly type="text" name="TenTG" id="" class="form-control bg-white" value="<?php echo $phieumuon->getMaTTV() ?>">
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="TenDS" class="control-label col-md-12">Thể loại</label>
                            <div class="col-md-12">
                                <input readonly type="text" name="TheLoai" id="" class="form-control bg-white" value="<?php echo $phieumuon->getMaNV(); ?>">
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="ngaysinh" class="control-label col-md-12">Ngày mượn</label>
                                <div class="col-md-12">
                                    <input readonly type="date" name="NgayMuon" id="" class="form-control bg-white" value="<?php echo $phieumuon->getNgayMuon() ?>">
                                    
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="sdt" class="control-label col-md-12">Ngày trả</label>
                                <div class="col-md-12">
                                    <input readonly type="date" name="NgayMuon" id="" class="form-control bg-white" value="<?php echo $phieumuon->getNgayTra() ?>">
                                    
                                </div>
                            </div>


                            
                        </div>

                        <div class="form-group">
                            <label for="luachon" class="control-label col-md-12">Lựa chọn</label>
                            <div class="col-md-12">
                                <input readonly type="text" name="luachon" id="" class="form-control bg-white" value="<?php echo $phieumuon->getLuaChon() ?>">
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <label for="trangthai" class="control-label col-md-12">Trạng thái</label>
                            <div class="col-md-12">
                                <input readonly type="text" name="trangthai" id="" class="form-control bg-white" value="<?php echo $phieumuon->getTrangThai() ?>">
                            </div>
                        </div>

                        

                    </div>

                    <div class="card-footer">
                        <a class="btn btn-primary" href="index.php?controller=phieumuon&action=index">Trở lại</a>
                    </div>

                </div>
            


            
        </div>

        <div>
         
            <?php if ($pp){?>
                <div class="card shadow mt-4 mb-2">
                
                    <div class="form-horizontal">
                        <div class="card-header bg-danger ">
                            <h4 class="font-weight-bold text-white d-flex justify-content-center align-items-center m-0">Thông tin phạt</h4>
                        </div>


                        <div class="card-body">
                            <!--Start form-->
                            

                            <div class="form-group">
                                <label for="TenTG" class="control-label col-md-12">Lý do</label>
                                <div class="col-md-12">
                                    <input readonly type="text" name="TenTG" id="" class="form-control bg-white" value="<?php echo $pp->LyDo ?>">
                                    
                                </div>
                            </div>

                            


                        </div>

                        

                    </div>
            


            
                </div>
            <?php }?>
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
        

</div>
    <script src="https://kit.fontawesome.com/d69cbc9d77.js" crossorigin="anonymous"></script>
</div>