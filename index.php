<?php
if (session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once 'Models/TaiKhoan.php';
require_once 'Controllers/HomeController.php';
require_once 'Controllers/LoginController.php';
require_once 'Controllers/SachController.php';
require_once 'Controllers/NhanVienController.php';
require_once 'Controllers/TaiKhoanController.php';
require_once 'Controllers/DocGiaController.php';
require_once 'Controllers/TheLoaiController.php';
require_once 'Controllers/PhieuMuonController.php';
require_once 'Controllers/ThongkeController.php';



$controller = null;

if (!isset($_SESSION['user'])) {
    $controller = new LoginController();
} else {
    $user = $_SESSION['user'];
    $cont = isset($_GET['controller']) ? $_GET['controller'] : null;
        switch ($cont) {
            case 'login':
                $controller = new LoginController();
                break;
            case 'home':
                $controller = new HomeController();
                break;
            case 'sach':
                $controller = new SachController();
                break;
            case 'nhanvien':
                if ($user['LoaiTK'] != "1"){
                    $controller = new LoginController();
                    break;
                } else {
                    $controller = new NhanVienController();
                    break;
                }
            case 'taikhoan':
                if ($user['LoaiTK'] != "1"){
                    $controller = new LoginController();
                    break;
                } else {
                    $controller = new TaiKhoanController();
                    break;
                }
                
            case 'docgia':
                $controller = new DocGiaController();
                break;
            case 'theloai':
                $controller = new TheLoaiController();
                break;
            case 'phieumuon':
                $controller = new PhieuMuonController();
                break;
            case 'thongkesach':
                $controller = new ThongKeController();
                break;
            default:
                $controller = new HomeController();
                break;
        }
}

$controller->handleRequest();
?>