<?php
require_once 'Models/dbconfig.php';

class Nguoi{
    private $MaNguoi;
    private $HoTen;
    private $NgaySinh;
    private $DiaChi;
    private $Sdt;

    public function __construct($MaNguoi, $HoTen, $NgaySinh, $DiaChi, $Sdt){
        $this->MaNguoi = $MaNguoi;
        $this->HoTen = $HoTen;
        $this->NgaySinh = $NgaySinh;
        $this->DiaChi = $DiaChi;
        $this->Sdt = $Sdt;
    }
    
    public function getMaNguoi(){
        return $this->MaNguoi;
    }
    public function getHoTen(){
        return $this->HoTen;
    }
    public function getNgaySinh(){
        return $this->NgaySinh;
    }
    public function getDiaChi(){
        return $this->DiaChi;
    }
    public function getSdt(){
        return $this->Sdt;
    }
    public function setMANguoi($MaNguoi){
        $this->MaNguoi = $MaNguoi;
    }
    public function setHoTen($HoTen){
        $this->HoTen = $HoTen;
    }
    public function setNgaySinh($NgaySinh){
        $this->NgaySinh = $NgaySinh;
    }
    public function setDiaChi($DiaChi){
        $this->DiaChi = $DiaChi;
    }
    public function setSdt($Sdt){
        $this->Sdt = $Sdt;
    }

    public static function getNguoibyID($MaNguoi){
        $db = Database::getInstance();
        $result = $db->getData('Nguoi','MaNguoi',$MaNguoi);
        $data = [];
        foreach($result as $row){
            $nguoi = new Nguoi($row['MaNguoi'],$row['HoTen'],$row['NgaySinh'],$row['DiaChi'],$row['Sdt']);
            $data[] = $nguoi;
        }
        return $data;
    }

    public static function getNguoinew(){
        $db = Database::getInstance();
        $result = $db->getDatas("SELECT * FROM Nguoi WHERE MaNguoi IN (SELECT MAX(MaNguoi) AS MaNguoi FROM Nguoi)");
        while ($row = $result->fetch()){
            return new Nguoi($row['MaNguoi'],$row['HoTen'],$row['NgaySinh'],$row['DiaChi'],$row['Sdt']);
        }
        return null;
    }

    public function addNguoi(){
        $db = Database::getInstance();

        // Tên của bảng
        $table = "Nguoi";

        // Mảng dữ liệu
        $data = array(
            "HoTen" => $this->HoTen,
            "NgaySinh" => $this->NgaySinh,
            "DiaChi" => $this->DiaChi,
            "Sdt"=> $this->Sdt
        );

        // Gọi hàm thêm dữ liệu vào bảng
        return $db->insert_data($table, $data);
    }

    public function editNguoi(){
        $db = Database::getInstance();
        

        // Tên của bảng
        $table = "Nguoi";

        // Mảng dữ liệu
        $data = array(
            "HoTen" => $this->HoTen,
            "NgaySinh" => $this->NgaySinh,
            "DiaChi" => $this->DiaChi,
            "Sdt"=> $this->Sdt
        );

        $where = "MaNguoi = '$this->MaNguoi'";

        // Gọi hàm thêm dữ liệu vào bảng
        return $db->update_data($table, $data, $where);
    }

    public function deleteNguoi(){
        $db = Database::getInstance();
        $table = "Nguoi";
        $where = "MaNguoi = '$this->MaNguoi'";

        return $db->delete_data($table, $where);
    }
    
}
?>