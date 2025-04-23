<?php
require_once 'Models/TheLoai.php';
require_once 'Models/DauSach.php';
class TheLoaiController {
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
        $index = "Views/TheLoai/index.php";
        $addlink = "index.php?controller=theloai&action=add";
        $content = "Views/Shared/IndexView/layout.php";
        $data = TheLoai::getAllTL();
        include "Views/Shared/HomeView/layout.php";
        
    }

    private function add() {
        $erorr = "";
        $erorr_name = "";
        $erorr_matl = "";

        if (isset($_POST["add_theloai"])) {
            $matl = $_POST["MaTL"];
            $tl =$_POST["TenTL"];

            if ($matl == "") {
                $erorr_matl = "Mã thể loại không được để trống";
                $content = "Views/TheLoai/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else if (TheLoai::getTLbyID($matl)){
                
                $erorr_matl = "Mã thể loại đã tồn tại";
                $content = "Views/TheLoai/add.php";
                include "Views/Shared/HomeView/layout.php";
            }else if ($tl == ""){
                $erorr_taikhoan = "Vui lòng nhập tên thể loại";
                $content = "Views/TheLoai/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else if (strlen($tl) < 6) {
                $erorr_taikhoan = "Vui lòng nhập tên thể loại tối thiểu 6 ký tự";
                $content = "Views/TheLoai/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else {
                $theloai = new TheLoai($matl,$tl);
                $result = $theloai->addTheLoai();
                if($result < 0){
                    $erorr = "Thêm thể loại không thành công";
                    $content = "Views/TaiKhoan/add.php";
                    include "Views/Shared/HomeView/layout.php";
                } else {
                    header("location:index.php?controller=theloai&action=index");
                }
            } 
            
        } else {
            $content = "Views/TheLoai/add.php";
            include "Views/Shared/HomeView/layout.php";
        }

    }

    private function edit() {
        $erorr = "";
        $erorr_name = "";
        if (isset($_GET["id"])) {
            $data = TheLoai::getTLbyID(intval($_GET["id"]));

            if (isset($_POST["edit_theloai"])) {
                $id =$_POST["MaTL"];
                $tl =$_POST["TenTL"];
    
                if ($tl == ""){
                    $erorr_taikhoan = "Vui lòng nhập tên thể loại";
                    $content = "Views/TheLoai/edit.php";
                    include "Views/Shared/HomeView/layout.php";
                } else if (strlen($tl) < 6) {
                    $erorr_taikhoan = "Vui lòng nhập tên thể loại tối thiểu 6 ký tự";
                    $content = "Views/TheLoai/edit.php";
                    include "Views/Shared/HomeView/layout.php";
                } else {
                    $theloai = new TheLoai($id,$tl);
                    $result = $theloai->editTheLoai();
                    if($result < 0){
                        $erorr = "Thêm thể loại không thành công";
                        $content = "Views/TaiKhoan/edit.php";
                        include "Views/Shared/HomeView/layout.php";
                    } else {
                        header("location:index.php?controller=theloai&action=index");
                    }
                } 
                
            } else {
                $content = "Views/TheLoai/edit.php";
                include "Views/Shared/HomeView/layout.php";
            }
        } else {
            echo "404 not found";
        }

        

        
    }

    private function delete() {
        if (isset($_GET["id"])){
            $id = $_GET["id"];
            $theloai = TheLoai::getTLbyID($id);
            if($theloai){
                $result = $theloai->deleteTheLoai();
                if ($result >= 0){
                    header("location:index.php?controller=theloai&action=index");
                } else {
                    
                }
            } else {
                
            }
        } else {}
        
    }

    private function detail() {

    }

    
}
?> 