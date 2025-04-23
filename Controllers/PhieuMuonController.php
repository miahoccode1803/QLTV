<?php
require_once 'Models/DauSach.php';
require_once 'Models/Sach.php';
require_once 'Models/TheLoai.php';
require_once 'Models/PhieuMuon.php';
require_once 'Models/ChiTietPhieuMuon.php';

class PhieuMuonController {
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
            case 'detail':
                $this->detail();
                break;
            case 'update':
                $this->update();
                break;
            case 'createPP':
                $this->createPP();
                break;
            case 'details':
                $this->details();
                break;
            default:
                $this->index();
                break;
        }
    }

    private function index() {
        $index = "Views/PhieuMuon/index.php";
        $addlink = "index.php?controller=phieumuon&action=add";
        $content = "Views/Shared/IndexView/layout.php";
        $data = PhieuMuon::getPhieuMuon();
        include "Views/Shared/HomeView/layout.php";
        
    }

    private function add() {
        $erorr = "";
        $erorr_mattv = "";
        $erorr_manv = "";
        $erorr_ngaymuon = "";
        $erorr_ngaytra = "";
        

        if (isset($_POST["add_phieumuon"])) {
            $MaTTV =$_POST["MaTTV"];
            $MaNV = $_SESSION['user']['MaNV'];
            $NgayMuon = $_POST["NgayMuon"];
            $NgayTra = $_POST["NgayTra"];
            $LuaChon = $_POST["LuaChon"];
            $TrangThai = $_POST["TrangThai"];
            $dateM = date_create($NgayMuon);
            $dateT = date_create($NgayTra);
            

            $thethuvien = TheThuVien::getTTVbyID($MaTTV);
            $phieumuon = new PhieuMuon("",$MaTTV, $MaNV, $NgayMuon , $NgayTra , $LuaChon ,$TrangThai);
            if ($MaTTV == ""){
                $erorr_mattv = "Vui lòng nhập mã thẻ thư viện";
                $content = "Views/PhieuMuon/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else if (!$thethuvien) {
                $erorr_mattv = "Thẻ thư viện không tồn tại!";
                $content = "Views/PhieuMuon/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else if($thethuvien->getThoiHan() < date("Y-m-d",time())) {
                $erorr_mattv = "Thẻ thư viện đã hết hạn!";
                $content = "Views/PhieuMuon/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else if($thethuvien->checkvar() <= 0) {
                $erorr_mattv = "Độc giả đã mượn tối đa sách có thể mượn";
                $content = "Views/PhieuMuon/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else if ($dateM > $dateT){
                $erorr_ngaymuon = "Ngày trả không thể nhỏ hơn ngày mượn";
                $content = "Views/PhieuMuon/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else if (date_diff($dateT, $dateM)->days > 7){
                $erorr_ngaymuon = "Số ngày mượn tối đa là 7 ngày";
                $content = "Views/PhieuMuon/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else if($phieumuon->check_pp()){
                $erorr_mattv = "Thẻ thư viện này không đủ điều kiện mượn";
                $content = "Views/PhieuMuon/add.php";
                include "Views/Shared/HomeView/layout.php";
            } else {
                $phieumuon = new PhieuMuon("",$MaTTV, $MaNV, $NgayMuon , $NgayTra , $LuaChon ,$TrangThai);
                $result = $phieumuon->addPhieuMuon();
                if($result < 0){
                    $erorr = "Thêm phiếu mượn không thành công";
                    $content = "Views/Sach/add.php";
                    include "Views/Shared/HomeView/layout.php";
                } else {
                    $phieumuon = PhieuMuon::getPhieuMuonNew();
                    $id = $phieumuon->getMaPM();
                    header("location:index.php?controller=phieumuon&action=detail&id=$id");
                }
            } 
            
        } else {
            $content = "Views/PhieuMuon/add.php";
            include "Views/Shared/HomeView/layout.php";
        }
    }

    private function edit() {
        $erorr = "";
        $erorr_namebook = "";
        $erorr_nametg = "";
        $erorr_cateid = "";
        $choicetl = TheLoai::getAllTL();

        if (isset($_GET["id"])){
            $id = $_GET["id"];
            $data = DauSach::getDS($id);
            if ($data){
                if (isset($_POST["edit_sach"])) {
                    $MaDS = $_POST["MaDS"];
                    $TenDS =$_POST["TenDS"];
                    $TenTG = $_POST["TenTG"];
                    $MaTL = $_POST["MaTL"];
        
                    if ($TenDS == ""){
                        $erorr_namebook = "Vui lòng nhập tên sách";
                        $content = "Views/Sach/edit.php";
                        include "Views/Shared/HomeView/layout.php";
                    } else if ($TenTG == "") {
                        $erorr_nametg = "Vui lòng nhập tên tác giả";
                        $content = "Views/Sach/edit.php";
                        include "Views/Shared/HomeView/layout.php";
                    } else if($MaTL == ""){
                        $erorr_cateid = "Vui lòng chọn thể loại";
                        $content = "Views/Sach/edit.php";
                        include "Views/Shared/HomeView/layout.php";
                    } else {
                        $dausach = new DauSach($MaDS ,$TenDS,"",$TenTG,new TheLoai($MaTL , ""));
                        $result = $dausach->editDauSach();
                        if($result < 0){
                            $erorr = "Cập nhật đầu sách không thành công";
                            $content = "Views/Sach/edit.php";
                            include "Views/Shared/HomeView/layout.php";
                        } else {
                            header("location:index.php?controller=sach&action=index");
                        }
                    } 
                    
                } else {
                    $content = "Views/Sach/edit.php";
                    include "Views/Shared/HomeView/layout.php";
                }
            } else {}
        } else {}
    }

    private function delete() {
        if (isset($_GET["id"])){
            $id = $_GET["id"];
            $phieumuon = PhieuMuon::getPhieuMuonbyID($id);
            if($phieumuon){
                $result = $phieumuon->deletePM();
                if ($result >= 0){
                    header("location:index.php?controller=phieumuon&action=index");
                } else {
                    
                }
            } else {
                
            }
        } else {}
    }

    private function detail(){
        if (isset($_GET["id"])){
            $id = $_GET["id"];
            $phieumuon = PhieuMuon::getPhieuMuonbyID($id);
            if($phieumuon){
                $ct = $phieumuon->getCTPM();
                $error = "";
                if (isset($_POST["add_sach"])){
                    $mapm = $_POST["MaPM"];
                    $sach = $_POST["MaSach"];
                    $s =Sach::getSachbyID($sach);
                    $pm = PhieuMuon::getPhieuMuonbyID($mapm);
                    $ttv = TheThuVien::getTTVbyID($pm->getMaTTV());
                    
                    if (!$s) {
                        $phieumuon = PhieuMuon::getPhieuMuonbyID($mapm);
                        $error = "Sách không tồn tại!";
                        $content = "Views/PhieuMuon/detail.php";
                        include "Views/Shared/HomeView/layout.php";
                    } else if($s->getTrangThai() != 1){
                        $phieumuon = PhieuMuon::getPhieuMuonbyID($mapm);
                        $error = "Sách đã được mượn ở nơi khác!";
                        $content = "Views/PhieuMuon/detail.php";
                        include "Views/Shared/HomeView/layout.php";
                    } else if($ttv->checkvar() <= 0){
                        $phieumuon = PhieuMuon::getPhieuMuonbyID($mapm);
                        $error = "Độc giả này đã mượn tối đa sách có thể mượn";
                        $content = "Views/PhieuMuon/detail.php";
                        include "Views/Shared/HomeView/layout.php";
                    } else {
                        $ct = new ChiTietPhieuMuon($mapm , $sach);
                        if ($ct->addCTPM() >= 0){
                            header("location:index.php?controller=phieumuon&action=detail&id=$mapm");
                        } else {
                            $error = "Thêm thất bại!";
                            $content = "Views/PhieuMuon/detail.php";
                            include "Views/Shared/HomeView/layout.php";
                        }
                    }

                    
                } else {
                    $content = "Views/PhieuMuon/detail.php";
                    include "Views/Shared/HomeView/layout.php";
                }
            }
        }
    }

    private function details(){
        if (isset($_GET["id"])){
            $id = $_GET["id"];
            $phieumuon = PhieuMuon::getPhieuMuonbyID($id);
            if($phieumuon){
                $ct = $phieumuon->getCTPM();
                $pp = PhieuPhat::getPPbyPM($phieumuon->getMaPM());
                $content = "Views/PhieuMuon/details.php";
                include "Views/Shared/HomeView/layout.php";

                    
            } else {
                
            }
        }
    }
    

    

    private function update(){
        if (isset($_GET["id"])){
            $id = $_GET["id"];
            $pm = PhieuMuon::getPhieuMuonbyID($id);
            if($pm){
                $pm->painPhieuMuon();
                
                header("location:index.php?controller=phieumuon&action=index");
                
            } else {
                
            }
        } else {}
    }

    private function createPP(){
        if (isset($_GET["id"])){
            $id = $_GET["id"];
            $pm = PhieuMuon::getPhieuMuonbyID($id);
            if($pm){
                $ct = $pm->getCTPM();
                if (isset($_POST["add_pp"])){
                    $Lydo = $_POST['lydo'];
                
                    $pp = new PhieuPhat("",$id,$Lydo);
                    
                    if ($pp->addPhieuPhat() >= 0){
                        $pm->createPP();
                        header("location:index.php?controller=phieumuon&action=details&id=$id");
                    } else {
                        
                    }
                }else{
                    $content = "Views/PhieuMuon/createPP.php";
                    include "Views/Shared/HomeView/layout.php";
                }
            } else {
                
            }
        } else {}
    }

    
}
?> 