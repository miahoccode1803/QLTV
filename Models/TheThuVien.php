<?php
require_once "Models/dbconfig.php";
require_once "Models/DocGia.php";
class TheThuVien
{
    private $MaTTV;
    public  $ThoiHan;
    public function __construct($MaTTV, $ThoiHan) {
        $this->MaTTV    = $MaTTV;
        $this->ThoiHan  = $ThoiHan;;
    }
    public function getMaTTV() {
        return $this->MaTTV;
    }
    public function setMaTTV($MaTTV) {
        $this->MaTTV = $MaTTV;
    }
    public function getThoiHan() {
        return $this->ThoiHan;
    }
    public function setThoiHan($ThoiHan) {
        $this->ThoiHan = $ThoiHan;
    }
    
    public static function getTTVnew(){
        $db = Database::getInstance();
        $result = $db->getData('TheThuVien');
        $ttv = null;
        foreach($result as $row){
            $ttv = new TheThuVien($row['MaTTV'], $row['ThoiHan']);
        }
        return $ttv;
    }

    public function getInfor(){
        $db = Database::getInstance();
        $sql = "SELECT COUNT(*) AS SL FROM PhieuMuon PM JOIN ChiTietPhieuMuon CT ON PM.MaPM = CT.MaPM JOIN Sach S ON CT.MaSach = S.MaSach WHERE PM.MaTTV = '$this->MaTTV' AND PM.TrangThai = 'Đang mượn'";
        $result = $db->getDatas($sql);
        while ($row = $result->fetch()){
            return $row["SL"];
        }
        return 9999;
    }

    public function checkvar(){
        $limited_sach = 0;
        $docgia = DocGia::getDocGiaByMaTTV($this->MaTTV);
        if ($docgia){
            if ($docgia->getLoaiDG() == 1){
                $limited_sach = 10;
            } else {
                $limited_sach = 7;
            }

            return $limited_sach - $this->getInfor();
        }

        return -9999;
    }

    public static function getTTVbyID($id){
        $db = Database::getInstance();
        $result = $db->getData('TheThuVien' , 'MaTTV' , $id);
        while($row = $result->fetch()){
            return new TheThuVien($row['MaTTV'], $row['ThoiHan']);
        }
        return null;
    }
    public function addTTV() {
        $db = Database::getInstance();

        // Tên của bảng
        $table = "TheThuVien";

        // Mảng dữ liệu
        $data = array(
            "MaTTV"      => $this->MaTTV,
            "ThoiHan"   => $this->ThoiHan,
        );

        // Gọi hàm thêm dữ liệu vào bảng
        return $db->insert_data($table, $data);
    }
    public function deleteTTV() {
        $db = Database::getInstance();
        
        $table = "TheThuVien";
        $where = "MaTTV = '$this->MaTTV'";

        return $db->delete_data($table, $where);
    }
}
?>