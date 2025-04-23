


<div class="d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card shadow mb-6 ">
            <form action="" method="post">
                <div class="form-horizontal">
                    <div class="card-header">
                        <h4 class="font-weight-bold text-primary d-flex justify-content-center align-items-center m-0">Biểu mẫu cập nhật tài khoản</h4>
                    </div>


                    <div class="card-body">
                        <span class="text-danger"><?php echo $erorr ?></span>
                        <!--Start form-->
                        

                        <div class="form-group">
                            <label for="taikhoan" class="control-label col-md-12">Tài khoản</label>
                            <div class="col-md-12">
                                <input type="text" name="taikhoan" id="" class="form-control" value="<?php echo $user->getTaiKhoan()?>">
                                <span class="text-danger"><?php echo $erorr_taikhoan ?></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-5">
                                <label for="matkhau" class="control-label col-md-12">Mật khẩu</label>
                                <div class="col-md-12">
                                    <input type="password" name="matkhau" id="password" class="form-control" value="<?php echo $user->getMatKhau()?>">
                                    <span class="text-danger"><?php echo $erorr_matkhau ?></span>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <label for="repass" class="control-label col-md-12">Nhập lại mật khẩu</label>
                                <div class="col-md-12">
                                    <!-- Ô nhập lại mật khẩu -->
                                    <input type="password" name="repass" id="confirm_password" class="form-control"/>

                                    <!-- Thẻ span để hiển thị thông báo lỗi -->
                                    <span class="text-danger" id="error_message"></span>

                                    <!-- Hàm JavaScript để kiểm tra mật khẩu và thêm nội dung cho thẻ span -->
                                    <script>
                                        // Lấy các phần tử input có id là password và confirm_password
                                        var password = document.getElementById("password");
                                        var confirm_password = document.getElementById("confirm_password");

                                        // Lấy phần tử span có id là error_message
                                        var error_message = document.getElementById("error_message");

                                        // Thêm sự kiện keyup cho cả hai input
                                        password.onkeyup = checkPassword;
                                        confirm_password.onkeyup = checkPassword;

                                        // Hàm kiểm tra mật khẩu và thêm nội dung cho thẻ span
                                        function checkPassword() {
                                            // Nếu mật khẩu và mật khẩu nhập lại không giống nhau
                                            if (password.value != confirm_password.value) {
                                            // Thêm nội dung cho thẻ span là "Mật khẩu không khớp"
                                                error_message.innerHTML = "Mật khẩu không khớp";
                                            
                                            } else {
                                            // Ngược lại, xóa nội dung của thẻ span
                                                error_message.innerHTML = "";
                                            }
                                        }
                                    </script>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <label for="taikhoan" class="control-label col-md-2"></label>
                                <div class="col-md-12">
                                    <!-- Nút bật tắt hiển thị mật khẩu -->
                                    <button type="button" class="btn" onclick="togglePassword()">
                                        <i id="icon-eye" class="fa-solid fa-eye-slash"></i>
                                    </button>
                                </div>
                                
                                

                                <!-- Hàm JavaScript để bật tắt hiển thị mật khẩu -->
                                <script>
                                    function togglePassword() {
                                        // Lấy phần tử input có id là password
                                        var password = document.getElementById("password");
                                        var repass = document.getElementById("confirm_password");
                                        var icon =document.getElementById("icon-eye");
                                        // Kiểm tra nếu type của input là password
                                        if (password.type == "password") {
                                            // Thay đổi type thành text để hiển thị mật khẩu
                                            password.type = "text";
                                            repass.type = "text";
                                            icon.classList.remove("fa-eye-slash");
                                            icon.classList.add("fa-eye");
                                            
                                        } else {
                                            // Ngược lại, thay đổi type thành password để ẩn mật khẩu
                                            password.type = "password";
                                            repass.type = "password";
                                            icon.classList.remove("fa-eye");
                                            icon.classList.add("fa-eye-slash");
                                        }
                                    }
                                </script>
                            </div>
                        </div>

                        
                        

                        <!--End Form-->
                        <div class="form-group d-flex align-items-center">
                            <div class="col-md-offset-2 col-md-5 text-right">
                                <input type="submit" name="add_taikhoan" value="Thêm" class="btn btn-primary pl-3 pr-3" />
                            </div>

                            <div class="col-md-offset-2 col-md-5 ">
                                <a href="index?controller=taikhoan&action=index" class="btn btn-default h4 pl-3 pr-3">Trở lại</a>
                            </div>
                        </div>


                    </div>





                </div>
            </form>


            <script src="https://kit.fontawesome.com/d69cbc9d77.js" crossorigin="anonymous"></script>
        </div>
    </div>
</div>


