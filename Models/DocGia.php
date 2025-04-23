<?php
require_once 'Models/dbconfig.php';
require_once ("Models/Nguoi.php");
require_once ("Models/PhieuMuon.php");
require_once ("Models/TheThuVien.php");

class DocGia extends Nguoi
{
    private $MaDG;
    public $LoaiDG;
    public $MaTTV;
    public function __construct($MaDG = null, $LoaiDG = null, $MaTTV = null, $MaNguoi = null , $HoTen = null , $NgaySinh = null , $DiaChi = null , $Sdt = null) {
        parent::__construct($MaNguoi , $HoTen , $NgaySinh , $DiaChi , $Sdt);
        $this->MaDG = $MaDG;
        $this->LoaiDG = $LoaiDG;
        $this->MaTTV = $MaTTV;   
    }
    public function getMaDG() {
        return $this->MaDG;
    }
    public function setMaDG($MaDG) {
        $this->MaDG = $MaDG;
    }
    public function getLoaiDG() {
        return $this->LoaiDG;
    }
    public function setLoaiDG($LoaiDG) {
        $this->LoaiDG = $LoaiDG;
    }
    public function getMaTTV() {
        return $this->MaTTV;
    }
    public function setMaTTV($MaTTV) {
        $this->MaTTV = $MaTTV;
    }
    public static function getData() {
        $docgias = [];
        $sql = "SELECT DocGia.MaDG, DocGia.LoaiDG, DocGia.MaTTV, Nguoi.MaNguoi, Nguoi.HoTen, Nguoi.NgaySinh, Nguoi.DiaChi, Nguoi.Sdt FROM DocGia, Nguoi WHERE DocGia.MaNguoi = Nguoi.MaNguoi;";
        $db = Database::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $docgias[] = new DocGia($row['MaDG'], $row['LoaiDG'], $row['MaTTV'], $row['MaNguoi'], $row['HoTen'],$row['NgaySinh'],$row['DiaChi'],$row['Sdt']);
        }
        return $docgias;
    }
    public static function getDocGiaById($id) {
        $db = Database::getInstance();
        $docgia = null;
        $sql = "SELECT * FROM DocGia, Nguoi WHERE DocGia.MaNguoi = Nguoi.MaNguoi AND DocGia.MaDG = '$id';";
        $result = $db->getDatas($sql);
        while($row = $result->fetch()){
            $docgia = new DocGia($row['MaDG'], $row['LoaiDG'], $row['MaTTV'], $row['MaNguoi'],$row['HoTen'],$row['NgaySinh'],$row['DiaChi'],$row['Sdt']);
        }
        return $docgia;
    }

    public static function getDocGiaByMaTTV($id){
        $sql = "SELECT * FROM DocGia, Nguoi, TheThuVien WHERE DocGia.MaNguoi = Nguoi.MaNguoi AND DocGia.MaTTV = TheThuVien.MaTTV AND DocGia.MaTTV = '$id';";
        $db = Database::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            return new DocGia($row['MaDG'], $row['LoaiDG'], $row['MaTTV'], $row['MaNguoi'],$row['HoTen'],$row['NgaySinh'],$row['DiaChi'],$row['Sdt']);
        }
        return null;
    }
    public function addDocGia(){
        $db = Database::getInstance();
        // Tên của bảng
        $table = "DocGia";
        $nguoi = new Nguoi($this->getMaNguoi(),$this->getHoTen(), $this->getNgaySinh(), $this->getDiaChi(),$this->getSdt());
        $nguoi->addNguoi();
        $nguoinew = $nguoi->getNguoinew();
        $currentDate = new DateTime();
        if ($this->LoaiDG == 1)
            $currentDate->modify('90 days');
        else
            $currentDate->modify('60 days');
        $futureDate = $currentDate->format('Y-m-d');
        
        $ttv = new TheThuVien($this->MaTTV, $futureDate);

        if ($ttv->addTTV() <= 0){
            return -10;
        }
        $ttvnew = $ttv->getTTVnew();
        // Mảng dữ liệu
        $data = array(
            "MaTTV"     =>  $ttvnew->getMaTTV(),
            "LoaiDG"    =>  $this->LoaiDG,
            "MaNguoi"   =>  $nguoinew->getMaNguoi(),
        );

        // Gọi hàm thêm dữ liệu vào bảng
        return $db->insert_data($table, $data);
    }
    public function editDocGia() {
        $docgia = DocGia::getDocGiaById($this->MaDG);
        if($docgia){
            return $this->editNguoi();
            
        }
        return -1;     
    }



    public function deleteDocGia(){
        $db = Database::getInstance();
        $docgia = DocGia::getDocGiaById($this->MaDG);
        if ($docgia){
            $pm = PhieuMuon::getPMbyDG($this->MaTTV);
            foreach ($pm as $phieumuon) {
                $phieumuon->deletePM();
            }

            $table = "DocGia";
            $where = "MaDG = '$this->MaDG'";
            $result = $db->delete_data($table, $where);
            if($result > 0){
                if($this->deleteNguoi() >= 0){
                    $thethuvien = TheThuVien::getTTVbyID($this->MaTTV);
                    if ($thethuvien->deleteTTV() >= 0){
                        return 1;
                    } else return -1;
                } else return -2;
            } else return -3;
            
        }
        return 0;
    }
}
?>