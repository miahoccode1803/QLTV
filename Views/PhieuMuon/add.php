


<div class="d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card shadow mb-6 ">
            <form action="" method="post">
                <div class="form-horizontal">
                    <div class="card-header">
                        <h4 class="font-weight-bold text-primary d-flex justify-content-center align-items-center m-0">Biểu mẫu thêm phiếu mượn</h4>
                    </div>


                    <div class="card-body">
                        <span class="text-danger"><?php echo $erorr ?></span>
                        <!--Start form-->

                        
                        <div class="form-group">
                            <label for="hoten" class="control-label col-md-12">Mã thẻ thư viện</label>
                            <div class="col-md-12">
                                <input type="text" name="MaTTV" id="mattv" class="form-control">
                                <span class="text-danger"><?php echo $erorr_mattv ?></span>
                                <span class="text-danger" id="error"></span>
                            </div>
                        </div>


                        <div style="display: none" id = "TheThuVien">
                            <div class="form-group">
                                <label for="hoten" class="control-label col-md-12">Họ tên</label>
                                <div class="col-md-12">
                                    <input readonly type="text" name="noname" id="hoten" class="form-control bg-white">

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="hoten" class="control-label col-md-12">Loại độc giả</label>
                                <div class="col-md-12">
                                    <input readonly type="text" name="noname" id="loaidg" class="form-control bg-white">

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="hoten" class="control-label col-md-12">Thời hạn</label>
                                <div class="col-md-12">
                                    <input readonly type="text" name="noname" id="thoihan" class="form-control bg-white">

                                </div>
                            </div>
                        </div>

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                        <script>
                            // Lấy tham chiếu đến thẻ input
                            var input = $('#mattv');
                            var thethuvien = document.getElementById('TheThuVien');
                            var error = document.getElementById('error');
                            var hoten = document.getElementById('hoten');
                            var loaidg = document.getElementById('loaidg');
                            var thoihan = document.getElementById('thoihan');

                            // Thêm sự kiện 'change' cho thẻ input
                            input.change(function() {
                                // Thực hiện yêu cầu AJAX
                                $.ajax({
                                    url: 'index.php?controller=docgia&action=getdata',
                                    type: 'POST',
                                    data: { ma: input.val() },
                                    success: function(data) {
                                        var result = JSON.parse(data);
                                        console.log(result);
                                        // In thông tin người dùng ra màn hình
                                        var tt = result.tt;
                                        if (tt == 1){
                                            thethuvien.style.display = 'block';
                                            hoten.value =result.hoten;
                                            if (result.loaidg == 1)
                                                loaidg.value = "Giáo viên";
                                            else
                                                loaidg.value = "Học sinh";
                                            thoihan.value =result.thoihan;
                                            error.textContent = "";
                                        }else {
                                            thethuvien.style.display = 'none';
                                            error.textContent = result.error;
                                        }
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        // Xử lý lỗi
                                        console.error(textStatus, errorThrown);
                                    }
                                });
                            });
                        </script>


                        <div class="form-group">
                            <label for="nv" class="control-label col-md-12">Nhân viên</label>
                            <div class="col-md-12">
                                <input readonly type="text" name="noname" value="<?php echo $_SESSION['user']['HoTen'] ?>" class="form-control bg-white">
                            </div>
                        </div>
                        

                        
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="ngaysinh" class="control-label col-md-12">Ngày mượn</label>
                                <div class="col-md-12">
                                    <input type="date" name="NgayMuon" id="" class="form-control">
                                    <span class="text-danger"><?php echo $erorr_ngaymuon ?></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="sdt" class="control-label col-md-12">Ngày trả</label>
                                <div class="col-md-12">
                                    <input type="date" name="NgayTra" id="" class="form-control">
                                    <span class="text-danger"><?php echo $erorr_ngaytra ?></span>
                                </div>
                            </div>


                            
                        </div>

                        <div class="form-group">
                            <label for="diachi" class="control-label col-md-12">Lựa chọn</label>
                            <div class="col-md-12">
                                <select class="form-control" name="LuaChon" id="">
                                    <option value="Tại chỗ">Tại chỗ</option>
                                    <option value="Mang về">Mang về</option>
                                </select>
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <label for="taikhoan" class="control-label col-md-12">Trạng thái</label>
                            <div class="col-md-12">
                                <select class="form-control" name="TrangThai" id="">
                                    <option value="Đang mượn">Đang mượn</option>
                                    <option value="Đã hoàn thành">Đã hoàn thành</option>
                                    <option value="Quá hạn">Quá hạn</option>
                                </select>
                            </div>
                        </div>

                        

                        
                        

                        <!--End Form-->
                        <div class="form-group d-flex align-items-center">
                            <div class="col-md-offset-2 col-md-5 text-right">
                                <input type="submit" name="add_phieumuon" value="Thêm" class="btn btn-primary pl-3 pr-3" />
                            </div>

                            <div class="col-md-offset-2 col-md-5 ">
                                <a href="index?controller=phieumuon&action=index" class="btn btn-default h4 pl-3 pr-3">Trở lại</a>
                            </div>
                        </div>


                    </div>

                </div>
            </form>


            <script src="https://kit.fontawesome.com/d69cbc9d77.js" crossorigin="anonymous"></script>
        </div>
    </div>
</div>


