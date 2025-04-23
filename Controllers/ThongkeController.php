<?php
require_once 'Models/TheLoai.php';
require_once 'Models/DauSach.php';
require_once 'Models/dbconfig.php';
require_once 'Models/PhieuMuon.php';
require_once 'Models/DocGia.php';

class ThongKeController {
    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : null;
        switch ($action) {
            case 'index':
                $this->thongkesach();
                break;
            case 'data':
                $this->datasach();
                break;
                case 'datapie':
                    $this->datasachpie();
                    break;
            case 'docgia':
                $this->docgia();
                break;
            case 'muontra':
                $this->muontra();
                break;
            case 'datapm':
                $this->datapm();
                break;
            case 'datapmpie':
                $this->datapmpie();
                break;
            case 'datadocgia':
                $this->datadocgia();
                break;
            case 'datadgpie':
                $this->datadgpie();
                break;
            default:
                $this->thongkesach();
                break;
        }
    }

    private function thongkesach() {
        $db = Database::getInstance();
        $sldausach = 0;
        $slsach = 0;
        $slsachmuon = 0;
        $slsachconlai = 0;

        $sql = "SELECT COUNT(MaDS) AS SLDS FROM DauSach";
        $result = $db->getDatas($sql);
        $sldausach = $result->fetch()["SLDS"];

        $sql = "SELECT COUNT(MaSach) AS SLS FROM Sach";
        $result = $db->getDatas($sql);
        $slsach = $result->fetch()["SLS"];

        $sql = "SELECT COUNT(MaSach) AS SLSM FROM Sach WHERE TrangThai = '0'";
        $result = $db->getDatas($sql);
        $slsachmuon = $result->fetch()["SLSM"];

        $sql = "SELECT COUNT(MaSach) AS SLCL FROM Sach WHERE TrangThai = '1'";
        $result = $db->getDatas($sql);
        $slsachconlai = $result->fetch()["SLCL"];

         
        $content = "Views/ThongKe/thongkesach.php";
        include "Views/Shared/HomeView/layout.php";
        
    }

    private function datasach() {
        $db = Database::getInstance();
        $sql = "SELECT AllMonths.Thang, IFNULL(SachMuon.SoLuongSachMuon, 0) AS SoLuong FROM ( SELECT 1 AS Thang UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12 ) AS AllMonths LEFT JOIN ( SELECT MONTH(NgayMuon) AS Thang, COUNT(*) AS SoLuongSachMuon FROM PhieuMuon PM JOIN ChiTietPhieuMuon CT ON PM.MaPM = CT.MaPM GROUP BY MONTH(NgayMuon) ) AS SachMuon ON AllMonths.Thang = SachMuon.Thang ORDER BY AllMonths.Thang;";
        // Truy vấn dữ liệu từ cơ sở dữ liệu
        $result = $db->getDatas($sql);
        $data = array();
        while ($row = $result->fetch()) {

            $thang = $row["Thang"];
            $data[] = array(
                "Thang"=> "Tháng $thang",
                "SoLuong"=> $row["SoLuong"],
            ); 
        }
        // Chuyển đổi dữ liệu thành định dạng JSON
        echo json_encode($data);
    }

    private function datasachpie() {
        $db = Database::getInstance();
        $sql = "SELECT TrangThai, COUNT(*) AS SoLuong FROM Sach WHERE TrangThai IN (0, 1) GROUP BY TrangThai;";
        // Truy vấn dữ liệu từ cơ sở dữ liệu
        $result = $db->getDatas($sql);
        $data = array();
        while ($row = $result->fetch()) {
            $field = "Thư viện";
            if ($row["TrangThai"] == 0) {
                $field = "Đang cho mượn";
            }
            $data[] = array(
                "TrangThai"=> $field,
                "SoLuong"=> $row["SoLuong"],
            ); 
        }
        // Chuyển đổi dữ liệu thành định dạng JSON
        echo json_encode($data);
    }
    private function docgia() {
       
        $db = Database::getInstance();
        $sldg = 0;
        $slnew = 0;
        $sldhd = 0;
        $slnhd = 0;

        $sql = "SELECT COUNT(MaDG) AS SLDS FROM DocGia";
        $result = $db->getDatas($sql);
        $sldg = $result->fetch()["SLDS"];

        $sql = "SELECT COUNT(MaDG) AS SLS FROM `docgia`, `thethuvien` WHERE docgia.MaTTV = thethuvien.MaTTV AND YEAR(thethuvien.ThoiHan) = YEAR(CURDATE());";
        $result = $db->getDatas($sql);
        $slnew = $result->fetch()["SLS"];

        $sql = "SELECT COUNT(MaDG) AS SLSM FROM `docgia`, `thethuvien` WHERE docgia.MaTTV = thethuvien.MaTTV AND thethuvien.ThoiHan >= CURDATE();";
        $result = $db->getDatas($sql);
        $sldhd = $result->fetch()["SLSM"];

        $sql = "SELECT COUNT(MaDG) AS SLCL FROM `docgia`, `thethuvien` WHERE docgia.MaTTV = thethuvien.MaTTV AND thethuvien.ThoiHan < CURDATE();";
        $result = $db->getDatas($sql);
        $slnhd = $result->fetch()["SLCL"];
        
        $content = "Views/ThongKe/thongkedocgia.php";
        include "Views/Shared/HomeView/layout.php";
        
    }

    private function datadocgia() {
        $db = Database::getInstance();
        $year = 2024;
        $sql = "SELECT AllMonths.Thang, IFNULL(TheThuVien.SoLuongTheMoi, 0) AS SoLuong FROM ( SELECT 1 AS Thang UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12 ) AS AllMonths LEFT JOIN ( SELECT MONTH(DATE_SUB(ThoiHan, INTERVAL IF(LoaiDG = 0, 60, 90) DAY)) AS Thang, COUNT(*) AS SoLuongTheMoi FROM TheThuVien JOIN DocGia ON TheThuVien.MaTTV = DocGia.MaTTV WHERE YEAR(DATE_SUB(ThoiHan, INTERVAL IF(LoaiDG = 0, 60, 90) DAY)) = '$year' GROUP BY MONTH(DATE_SUB(ThoiHan, INTERVAL IF(LoaiDG = 0, 60, 90) DAY)) ) AS TheThuVien ON AllMonths.Thang = TheThuVien.Thang ORDER BY AllMonths.Thang;";
        // Truy vấn dữ liệu từ cơ sở dữ liệu
        $result = $db->getDatas($sql);
        $data = array();
        while ($row = $result->fetch()) {

            $thang = $row["Thang"];
            $data[] = array(
                "Thang"=> "Tháng $thang",
                "SoLuong"=> $row["SoLuong"],
            ); 
        }
        // Chuyển đổi dữ liệu thành định dạng JSON
        echo json_encode($data);
    }

    private function datadgpie() {
        $db = Database::getInstance();
        $year = 2024;
        $sql = "SELECT CASE WHEN ThoiHan < CURDATE() THEN 'Ngừng hoạt động' ELSE 'Đang hoạt động' END AS TrangThai, COUNT(*) AS SoLuong FROM TheThuVien GROUP BY TrangThai;";
        // Truy vấn dữ liệu từ cơ sở dữ liệu
        $result = $db->getDatas($sql);
        $data = array();
        while ($row = $result->fetch()) {   
            $data[] = array(
                "TrangThai"=> $row["TrangThai"],
                "SoLuong"=> $row["SoLuong"],
            ); 
        }
        // Chuyển đổi dữ liệu thành định dạng JSON
        echo json_encode($data);
    }


    private function muontra() {

        $db = Database::getInstance();
        $slpm = 0;
        $sldcm = 0;
        $sldht = 0;
        $slvp = 0;

        $sql = "SELECT COUNT(MaPM) AS SLDS FROM PhieuMuon";
        $result = $db->getDatas($sql);
        $sldausach = $result->fetch()["SLDS"];

        $sql = "SELECT COUNT(MaPM) AS SLS FROM PhieuMuon WHERE TrangThai = 'Đang mượn'";
        $result = $db->getDatas($sql);
        $slsach = $result->fetch()["SLS"];

        $sql = "SELECT COUNT(MaPM) AS SLSM FROM PhieuMuon WHERE TrangThai = 'Đã hoàn thành'";
        $result = $db->getDatas($sql);
        $slsachmuon = $result->fetch()["SLSM"];

        $sql = "SELECT COUNT(MaPM) AS SLCL FROM PhieuMuon WHERE TrangThai = 'Đã Phạt'";
        $result = $db->getDatas($sql);
        $slsachconlai = $result->fetch()["SLCL"];
        
        $content = "Views/ThongKe/thongkemuontra.php";
        include "Views/Shared/HomeView/layout.php";
            
        
    }

    private function datapm() {
        $db = Database::getInstance();
        $year = 2024;
        $sql = "SELECT AllMonths.Thang, IFNULL(PhieuMuon.SoLuongPhieuMuon, 0) AS SoLuong FROM ( SELECT 1 AS Thang UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12 ) AS AllMonths LEFT JOIN ( SELECT MONTH(NgayMuon) AS Thang, COUNT(*) AS SoLuongPhieuMuon FROM PhieuMuon WHERE YEAR(NgayMuon) = '$year' GROUP BY MONTH(NgayMuon) ) AS PhieuMuon ON AllMonths.Thang = PhieuMuon.Thang ORDER BY AllMonths.Thang;";
        // Truy vấn dữ liệu từ cơ sở dữ liệu
        $result = $db->getDatas($sql);
        $data = array();
        while ($row = $result->fetch()) {

            $thang = $row["Thang"];
            $data[] = array(
                "Thang"=> "Tháng $thang",
                "SoLuong"=> $row["SoLuong"],
            ); 
        }
        // Chuyển đổi dữ liệu thành định dạng JSON
        echo json_encode($data);
    }

    private function datapmpie() {
        $db = Database::getInstance();
        $year = 2024;
        $sql = "SELECT TrangThai, COUNT(*) AS SoLuong FROM PhieuMuon WHERE YEAR(NgayMuon) = '$year' AND TrangThai IN ('Đã hoàn thành', 'Đã phạt') GROUP BY TrangThai;";
        // Truy vấn dữ liệu từ cơ sở dữ liệu
        $result = $db->getDatas($sql);
        $data = array();
        while ($row = $result->fetch()) {   
            $data[] = array(
                "TrangThai"=> $row["TrangThai"],
                "SoLuong"=> $row["SoLuong"],
            ); 
        }
        // Chuyển đổi dữ liệu thành định dạng JSON
        echo json_encode($data);
    }

    
    
}
?> 