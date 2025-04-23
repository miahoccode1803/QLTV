<?php
require_once 'Models/TaiKhoan.php';
class TaiKhoanController {
    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : null;
        switch ($action) {
            case 'index':
                $this->index();
                break;
            case 'add':
                $this->add();
                break;
            case 'edit':
                $this->edit();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                $this->index();
                break;
        }
    }

    private function index() {
        $index = "Views/TaiKhoan/index.php";
        $addlink = "index.php?controller=taikhoan&action=add";
        $content = "Views/Shared/IndexView/layout.php";
        $data = TaiKhoan::getAllUser();
        include "Views/Shared/HomeView/layout.php";
    }

    private function add() {
        $erorr ="";
        $erorr_taikhoan ="";
        $erorr_matkhau ="";
        if (isset($_POST["add_taikhoan"])) {
            $taikhoan =$_POST["taikhoan"];
            $matkhau =$_POST["matkhau"];

            if ($taikhoan == ""){
                $erorr_taikhoan = "Vui lòng nhập tài khoản";
                $content = "Views/TaiKhoan/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else if (strlen($taikhoan) < 6) {
                $erorr_taikhoan = "Vui lòng nhập tài khoản tối thiểu 6 ký tự";
                $content = "Views/TaiKhoan/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else if ($matkhau == ""){
                $erorr_matkhau = "Vui lòng nhập mật khẩu";
                $content = "Views/TaiKhoan/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else if (strlen($matkhau) < 6) {
                $erorr_matkhau = "Vui lòng nhập mật khẩu tối thiểu 6 ký tự";
                $content = "Views/TaiKhoan/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else {
                $user = new TaiKhoan($taikhoan,$matkhau,"0");
                $result = $user->addTaiKhoan();
                if ($result == -2){
                    $erorr = "Thêm tài khoản không thành công!(Tài khoản đã tồn tại)";
                    $content = "Views/TaiKhoan/add.php";
                    include "Views/Shared/HomeView/layout.php";
                } else if($result < 0){
                    $erorr = "Thêm tài khoản không thành công";
                    $content = "Views/TaiKhoan/add.php";
                    include "Views/Shared/HomeView/layout.php";
                } else {
                    header("location:index.php?controller=taikhoan&action=index");
                }
            } 
            
        } else {
            $content = "Views/TaiKhoan/add.php";
            include "Views/Shared/HomeView/layout.php";
        }
        
    }

    private function edit() {

        $erorr ="";
        $erorr_taikhoan ="";
        $erorr_matkhau ="";

        if (isset($_GET["id"])){
            $id = $_GET["id"];
            $user = TaiKhoan::getUserByuserName($id);
            if ($user){
                if (isset($_POST["edit_nhanvien"])){
                    $taikhoan =$_POST["taikhoan"];
                    $matkhau =$_POST["matkhau"];
                    $loaitk = $_POST["loaitk"];

                    if ($taikhoan == ""){
                        $erorr_taikhoan = "Vui lòng nhập tài khoản";
                        $content = "Views/TaiKhoan/edit.php";
                        include "Views/Shared/HomeView/layout.php";
                    } else if (strlen($taikhoan) < 6) {
                        $erorr_taikhoan = "Vui lòng nhập tài khoản tối thiểu 6 ký tự";
                        $content = "Views/TaiKhoan/edit.php";
                        include "Views/Shared/HomeView/layout.php";
                    } else if ($matkhau == ""){
                        $erorr_matkhau = "Vui lòng nhập mật khẩu";
                        $content = "Views/TaiKhoan/edit.php";
                        include "Views/Shared/HomeView/layout.php";
                    } else if (strlen($matkhau) < 6) {
                        $erorr_matkhau = "Vui lòng nhập mật khẩu tối thiểu 6 ký tự";
                        $content = "Views/TaiKhoan/edit.php";
                        include "Views/Shared/HomeView/layout.php";
                    } else {
                        
                        $taikhoan = new TaiKhoan($taikhoan,$matkhau,"0");
                        $result = $taikhoan->editTaiKhoan();
                        if ($result == -2){
                            $erorr = "Cập nhật tài khoản không thành công!";
                            $content = "Views/NhanVien/edit.php";
                            include "Views/Shared/HomeView/layout.php";
                        } else if($result < 0){
                            $erorr = "Cập nhật tài khoản không thành công";
                            $content = "Views/TaiKhoan/edit.php";
                            include "Views/Shared/HomeView/layout.php";
                        } else {
                            header("location:index.php?controller=taikhoan&action=index");
                        }
                    } 
                } else {
                    $content = "Views/TaiKhoan/edit.php";
                    include "Views/Shared/HomeView/layout.php";
                }
            } else {
                echo "Tài khoản không tồn tại";
            }

        } else {
            echo "Không tồn tại tài khoản này";
        }
        
    }

    private function delete() {
        if (isset($_GET["id"])){
            $id = $_GET["id"];
            $taikhoan = TaiKhoan::getUserByuserName($id);
            if($taikhoan){
                $result = $taikhoan->deleteTaiKhoan();
                if ($result >= 0){
                    header("location:index.php?controller=taikhoan&action=index");
                } else {}
            } else {}
        } else {}
        
    }


    
}
?> 