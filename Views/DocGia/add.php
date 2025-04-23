


<div class="d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card shadow mb-6 ">
            <form action="" method="post">
                <div class="form-horizontal">
                    <div class="card-header">
                        <h4 class="font-weight-bold text-primary d-flex justify-content-center align-items-center m-0">Biểu mẫu thêm độc giả</h4>
                    </div>
                    <div class="card-body">
                        <span class="text-danger"><?php echo $erorr ?></span>
                        <!--Start form-->
                        <div class="form-group">
                            <label for="loaidg" class="control-label col-md-12">Loại độc giả</label>
                            <div class="col-md-12">
                                <select name="loaidg" class="form-control" id="">
                                    <option class="form-control" value="0">Học sinh</option>
                                    <option class="form-control" value="1">Giáo viên</option>
                                </select>
                                <span class="text-danger"><?php echo $erorr_loaidg ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mattv" class="control-label col-md-12">Mã thẻ thư viện</label>
                            <div class="col-md-12">
                                <input type="text" name="mattv" id="" class="form-control">
                                <span class="text-danger"><?php echo $erorr_mattv ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hoten" class="control-label col-md-12">Họ tên</label>
                            <div class="col-md-12">
                                <input type="text" name="hoten" id="" class="form-control">
                                <span class="text-danger"><?php echo $erorr_hoten ?></span>
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label for="ngaysinh" class="control-label col-md-12">Ngày sinh</label>
                                <div class="col-md-12">
                                    <input type="date" name="ngaysinh" id="" class="form-control">
                                    <span class="text-danger"><?php echo $erorr_ngaysinh ?></span>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <label for="sdt" class="control-label col-md-12">Số điện thoại</label>
                                <div class="col-md-12">
                                    <input type="text" name="sdt" id="" class="form-control">
                                    <span class="text-danger"><?php echo $erorr_sdt ?></span>
                                </div>
                            </div>                            
                        </div>

                        <div class="form-group">
                            <label for="diachi" class="control-label col-md-12">Địa chỉ</label>
                            <div class="col-md-12">
                                <input type="text" name="diachi" id="" class="form-control">
                                <span class="text-danger"><?php echo $erorr_diachi ?></span>
                            </div>
                        </div>
                        <!--End Form-->
                        <div class="form-group d-flex align-items-center">
                            <div class="col-md-offset-2 col-md-5 text-right">
                                <input type="submit" name="add_docgia" value="Thêm" class="btn btn-primary pl-3 pr-3" />
                            </div>

                            <div class="col-md-offset-2 col-md-5 ">
                                <a href="index?controller=docgia&action=index" class="btn btn-default h4 pl-3 pr-3">Trở lại</a>
                            </div>
                        </div>


                    </div>





                </div>
            </form>


            <script src="https://kit.fontawesome.com/d69cbc9d77.js" crossorigin="anonymous"></script>
        </div>
    </div>
</div>


