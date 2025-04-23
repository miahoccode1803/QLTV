<?php
require_once 'Models/dbconfig.php';
class HomeController {
    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : null;
        switch ($action) {
            case 'index':
                $this->index();
                break;
            case 'logout':
                $this->logout();
                break;
            case '403':
                $this->e403();
                break;
            default:
                $this->index();
                break;
        }
    }

    private function index() {
        $slSach = 0;
        $slDG = 0;
        $slDM = 0;
        $slQH = 0;
        $sql = "SELECT COUNT(MaSach) AS Soluong FROM Sach";
        $db = Database::getInstance();
        $result = $db->getDatas($sql);
        while ($row = $result->fetch()) {
            $slSach = $row['Soluong'];
        }

        $sql = "SELECT COUNT(MaDG) AS Soluong FROM DocGia";
        $db = Database::getInstance();
        $result = $db->getDatas($sql);
        while ($row = $result->fetch()) {
            $slDG = $row['Soluong'];
        }

        $sql = "SELECT COUNT(MaSach) AS Soluong FROM Sach WHERE TrangThai = '1'";
        $db = Database::getInstance();
        $result = $db->getDatas($sql);
        while ($row = $result->fetch()) {
            $slDM = $row['Soluong'];
        }

        $sql = "SELECT COUNT(MaPM) AS Soluong FROM PhieuMuon WHERE TrangThai='Quá hạn'";
        $db = Database::getInstance();
        $result = $db->getDatas($sql);
        while ($row = $result->fetch()) {
            $slQH = $row['Soluong'];
        }
        
        $content = "Views/Home/Home.php";
        include "Views/Shared/HomeView/layout.php";
    }

    private function e403(){
        $content = "Views/Home/error403.php";
        include "Views/Shared/HomeView/layout.php";
    }

    private function logout() {
        $_SESSION['user'] = null;
        require 'index.php';
    }
}
?> 