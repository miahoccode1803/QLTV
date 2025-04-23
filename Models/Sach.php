<?php
require_once 'Models/dbconfig.php';

class Sach {

    private $MaSach;
    private $MaDS;
    public $TrangThai;

    public $DauSach;

    public function __construct($MaSach , $MaDS , $TrangThai){
        $this->MaSach = $MaSach;
        $this->MaDS = $MaDS;
        $this->TrangThai = $TrangThai;
    }

    public function getMaSach(){
        return $this->MaSach;
    }
    public function getMaDS(){
        return $this->MaDS;
    }
    public function getTrangThai(){
        return $this->TrangThai;
    }
    public function setMaSach($MaSach){
        $this->MaSach = $MaSach;
    }
    public function setMaDS($MaDS){
        $this->MaDS = $MaDS;
    }
    public function setTrangThai($TrangThai){
        $this->TrangThai = $TrangThai;
    }

    public static function getSachbyID($masach) {
        $db = Database::getInstance();
        $sql = "SELECT * FROM `Sach`,`DauSach` WHERE Sach.MaDS = DauSach.MaDS AND Sach.MaSach = '$masach'";

        $result = $db->getDatas($sql);
        while($row = $result->fetch()){
            $sach = new Sach($row['MaSach'],$row['MaDS'],$row['TrangThai']);
            $sach->DauSach = new DauSach($row['MaDS'],$row['TenDS'],$row['SoLuong'], $row['TenTG'] , $row['MaTL']);
            return $sach;
        }
        return null;
    }
    
    
    public function addSach(){
        $db = Database::getInstance();

        // Tên của bảng
        $table = "Sach";

        // Mảng dữ liệu
        $data = array(
            "MaSach" => $this->MaSach,
            "MaDS" => $this->MaDS,
            "TrangThai" => $this->TrangThai
        );

        $result = $db->insert_data($table, $data);
        if($result > 0){
            $dausach = DauSach::getDS($this->MaDS);
            $dausach->setSoLuong($dausach->getSoLuong() + 1);
            $r = $dausach->updateDauSach();
        } else {
            return 0;
        }

        // Gọi hàm thêm dữ liệu vào bảng
        return $r;
    }

    public function editSach(){
        $db = Database::getInstance();

        // Tên của bảng
        $table = "Sach";

        // Mảng dữ liệu
        $data = array(
            "MaDS" => $this->MaDS,
            "TrangThai" => $this->TrangThai
        );

        $where = "MaSach = '$this->MaSach'";
        // Gọi hàm thêm dữ liệu vào bảng
        return $db->update_data($table, $data, $where);
    }

    public function painSach(){
        $this->TrangThai = 1;
        $this->editSach();
    }

    public function buySach(){
        $this->TrangThai = 0;
        $this->editSach();
    }


    public function deleteSach(){
        $db = Database::getInstance();
        
        $table = "Sach";
        $where = "MaSach = '$this->MaSach'";
        try {
            $sql = "DELETE TABLE ChiTietPhieuMuon WHERE $where";
            $db->getDatas($sql);
        } catch (Exception $e) {
            
        }

        $result =  $db->delete_data($table, $where);
        if($result > 0){
            $dausach = DauSach::getDS($this->MaDS);
            $dausach->setSoLuong($dausach->getSoLuong() - 1);
            $r = $dausach->updateDauSach();
        } else {
            return 0;
        }

        // Gọi hàm thêm dữ liệu vào bảng
        return $r;
    }

}
?>
