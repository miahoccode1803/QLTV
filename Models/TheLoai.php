<?php
require_once 'Models/dbconfig.php';
require_once 'Models/DauSach.php';

class TheLoai {

    private $MaTL;
    private $TenTL;


    public function __construct($MaTL , $TenTL) {
        $this->MaTL = $MaTL;
        $this->TenTL = $TenTL;
    }

    public function getMaTL() {
        return $this->MaTL;
    }

    public function getTenTL() {
        return $this->TenTL;
    }
    public function setMaTL($MaTL) {
        $this->MaTL = $MaTL;
    }
    public function setTenTL($TenTL) {
        $this->TenTL = $TenTL;
    }
    
    
    public static function getAllTL() {
        $db = Database::getInstance();
        $result = $db->getData('TheLoai');
        $theloais = [];

        while ($row = $result->fetch()) {
            $theloais[] = new TheLoai($row['MaTL'], $row['TenTL']);
        }

        return $theloais;
    }

    public static function getTLbyID($id) {
        $db = Database::getInstance();
        $result = $db->getData('TheLoai','MaTL', $id);

        if ($result) {
            while ($row = $result->fetch()) {
                return new TheLoai($row['MaTL'], $row['TenTL']);
            }
        }

        return null;
    }

    public static function getDauSach($MaTL) {
        $db = Database::getInstance();

        $sql = "SELECT * FROM `TheLoai` , `DauSach` WHERE TheLoai.MaTL = DauSach.MaTL AND TheLoai.MaTL = '$MaTL';";
        $result = $db->getDatas($sql);
        $dausachs = [];
        while ($row = $result->fetch()) {
            $dausachs[] = new DauSach($row['MaDS'] ,$row['TenDS'] , $row['SoLuong'] , $row['TenTG'] , new TheLoai($row['MaTL'] , $row['TenTL']));

        }
        

        return $dausachs;
    }
    
    public function addTheLoai(){
        $db = Database::getInstance();

        // Tên của bảng
        $table = "TheLoai";

        // Mảng dữ liệu
        $data = array(
            "MaTL" => $this->MaTL,
            "TenTL" => $this->TenTL
        );

        // Gọi hàm thêm dữ liệu vào bảng
        return $db->insert_data($table, $data);
    }

    public function editTheLoai(){
        $db = Database::getInstance();

        // Tên của bảng
        $table = "TheLoai";

        // Mảng dữ liệu
        $data = array(
            "TenTL" => $this->TenTL
        );

        $where = "MaTL = '$this->MaTL'";
        // Gọi hàm thêm dữ liệu vào bảng
        return $db->update_data($table, $data, $where);
    }

    public function deleteTheLoai(){
        $db = Database::getInstance();

        $dausachs = TheLoai::getDauSach($this->MaTL);
        foreach ($dausachs as $ds){
            $ds->deleteDauSach();
        }

        
        $table = "TheLoai";
        $where = "MaTL = '$this->MaTL'";

        return $db->delete_data($table, $where);
    }

}
?>
