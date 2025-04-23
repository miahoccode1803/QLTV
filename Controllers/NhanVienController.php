<?php
require_once 'Models/NhanVien.php';
class NhanVienController {
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
        $index = "Views/NhanVien/index.php";
        $addlink = "index.php?controller=nhanvien&action=add";
        $content = "Views/Shared/IndexView/layout.php";
        $data = NhanVien::getData();
        include "Views/Shared/HomeView/layout.php";
    }

    private function add() {
        $erorr ="";
        $erorr_manv ="";
        $erorr_hoten ="";
        $erorr_ngaysinh ="";
        $erorr_diachi ="";
        $erorr_sdt ="";
        $erorr_taikhoan ="";
        $erorr_matkhau ="";
        if (isset($_POST["add_nhanvien"])) {
            $hoten =$_POST["hoten"];
            $ngaysinh =$_POST["ngaysinh"];
            $diachi =$_POST["diachi"];
            $sdt =$_POST["sdt"];
            $taikhoan =$_POST["taikhoan"];
            $matkhau =$_POST["matkhau"];
            $loaitk =$_POST["loaitk"];

            if ($hoten == "") {
                $erorr_hoten = "Vui lòng nhập họ tên";
                $content = "Views/NhanVien/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else if ($ngaysinh == "") {
                $erorr_ngaysinh = "Vui lòng nhập ngày sinh";
                $content = "Views/NhanVien/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else if ($diachi == "") {
                $erorr_diachi = "Vui lòng nhập địa chỉ";
                $content = "Views/NhanVien/add.php";
                include "Views/Shared/HomeView/layout.php";
                
            } else if ($sdt == "") {
                $erorr_sdt = "Vui lòng nhập số điện thoại";
                $content = "Views/NhanVien/add.php";
                include "Views/Shared/HomeView/layout.php";
                
            } else if (strlen($sdt) != 10) {

                $erorr_sdt = "Vui lòng nhập đúng định dạng số điện thoại gồm 10 chữ số";
                $content = "Views/NhanVien/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else if ($taikhoan == ""){
                $erorr_taikhoan = "Vui lòng nhập tài khoản";
                $content = "Views/NhanVien/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else if (strlen($taikhoan) < 6) {
                $erorr_taikhoan = "Vui lòng nhập tài khoản tối thiểu 6 ký tự";
                $content = "Views/NhanVien/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else if ($matkhau == ""){
                $erorr_matkhau = "Vui lòng nhập mật khẩu";
                $content = "Views/NhanVien/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else if (strlen($matkhau) < 6) {
                $erorr_matkhau = "Vui lòng nhập mật khẩu tối thiểu 6 ký tự";
                $content = "Views/NhanVien/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else {
                $nv = new NhanVien();
                $nv->setHoTen($hoten);
                $nv->setNgaySinh($ngaysinh);
                $nv->setDiaChi($diachi);
                $nv->setSdt($sdt);
                $nv->setTaiKhoan(new TaiKhoan($taikhoan,$matkhau,$loaitk));
                $result = $nv->addNhanVien();
                if ($result == -2){
                    $erorr = "Thêm nhân viên không thành công!(Tài khoản đã tồn tại)";
                    $content = "Views/NhanVien/add.php";
                    include "Views/Shared/HomeView/layout.php";
                } else if($result < 0){
                    $erorr = "Thêm nhân viên không thành công";
                    $content = "Views/NhanVien/add.php";
                    include "Views/Shared/HomeView/layout.php";
                } else {
                    header("location:index.php?controller=nhanvien&action=index");
                }
            } 
            
        } else {
            $content = "Views/NhanVien/add.php";
            include "Views/Shared/HomeView/layout.php";
        }
        
    }

    private function edit() {

        $erorr ="";
        $erorr_manv ="";
        $erorr_hoten ="";
        $erorr_ngaysinh ="";
        $erorr_diachi ="";
        $erorr_sdt ="";
        $erorr_taikhoan ="";
        $erorr_matkhau ="";

        if (isset($_GET["id"])){
            $id = $_GET["id"];
            $nhanvien = NhanVien::getNhanVienbyID($id);
            if ($nhanvien){
                if (isset($_POST["edit_nhanvien"])){
                    $nhanvien_id = $_POST["id"];
                    $hoten =$_POST["hoten"];
                    $ngaysinh =$_POST["ngaysinh"];
                    $diachi =$_POST["diachi"];
                    $sdt =$_POST["sdt"];
                    $taikhoan =$_POST["taikhoan"];
                    $matkhau =$_POST["matkhau"];

                    if ($hoten == "") {
                        $erorr_hoten = "Vui lòng nhập họ tên";
                        $content = "Views/NhanVien/edit.php";
                        include "Views/Shared/HomeView/layout.php";
                    } else if ($ngaysinh == "") {
                        $erorr_ngaysinh = "Vui lòng nhập ngày sinh";
                        $content = "Views/NhanVien/edit.php";
                        include "Views/Shared/HomeView/layout.php";
                    } else if ($diachi == "") {
                        $erorr_diachi = "Vui lòng nhập địa chỉ";
                        $content = "Views/NhanVien/edit.php";
                        include "Views/Shared/HomeView/layout.php";
                        
                    } else if ($sdt == "") {
                        $erorr_sdt = "Vui lòng nhập số điện thoại";
                        $content = "Views/NhanVien/edit.php";
                        include "Views/Shared/HomeView/layout.php";
                        
                    } else if (strlen($sdt) != 10) {

                        $erorr_sdt = "Vui lòng nhập đúng định dạng số điện thoại gồm 10 chữ số";
                        $content = "Views/NhanVien/edit.php";
                        include "Views/Shared/HomeView/layout.php";
                    } else if ($taikhoan == ""){
                        $erorr_taikhoan = "Vui lòng nhập tài khoản";
                        $content = "Views/NhanVien/edit.php";
                        include "Views/Shared/HomeView/layout.php";
                    } else if (strlen($taikhoan) < 6) {
                        $erorr_taikhoan = "Vui lòng nhập tài khoản tối thiểu 6 ký tự";
                        $content = "Views/NhanVien/edit.php";
                        include "Views/Shared/HomeView/layout.php";
                    } else if ($matkhau == ""){
                        $erorr_matkhau = "Vui lòng nhập mật khẩu";
                        $content = "Views/NhanVien/edit.php";
                        include "Views/Shared/HomeView/layout.php";
                    } else if (strlen($matkhau) < 6) {
                        $erorr_matkhau = "Vui lòng nhập mật khẩu tối thiểu 6 ký tự";
                        $content = "Views/NhanVien/edit.php";
                        include "Views/Shared/HomeView/layout.php";
                    } else {
                        $nv = new NhanVien();
                        $nv->setMaNV($nhanvien_id);
                        $nv->setHoTen($hoten);
                        $nv->setNgaySinh($ngaysinh);
                        $nv->setDiaChi($diachi);
                        $nv->setSdt($sdt);
                        $nv->setTaiKhoan(new TaiKhoan($taikhoan,$matkhau,"0"));
                        $result = $nv->editNhanVien();
                        if ($result == -2){
                            $erorr = "Cập nhật nhân viên không thành công!";
                            $content = "Views/NhanVien/edit.php";
                            include "Views/Shared/HomeView/layout.php";
                        } else if($result < 0){
                            $erorr = "Cập nhật nhân viên không thành công";
                            $content = "Views/NhanVien/edit.php";
                            include "Views/Shared/HomeView/layout.php";
                        } else {
                            header("location:index.php?controller=nhanvien&action=index");
                        }
                    } 
                } else {
                    $content = "Views/NhanVien/edit.php";
                    include "Views/Shared/HomeView/layout.php";
                }
            } else {
                echo "Nhân viên không tồn tại";
            }

        } else {
            echo "Không tồn tại nhân viên này";
        }
        
    }

    private function delete() {
        if (isset($_GET["id"])){
            $id = $_GET["id"];
            $nhanvien = NhanVien::getNhanVienbyID($id);
            if($nhanvien){
                $result = $nhanvien->deleteNhanVien();
                if ($result >= 0){
                    header("location:index.php?controller=nhanvien&action=index");
                } else {}
            } else {}
        } else {}
        
    }


    
}
?> 