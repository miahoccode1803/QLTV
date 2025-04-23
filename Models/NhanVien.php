<?php
require_once("Models/TaiKhoan.php");
require_once("Models/Nguoi.php");
require_once 'Models/dbconfig.php';
class NhanVien extends Nguoi{
    private $MaNV;
    public $TaiKhoan;
    public function __construct($MaNguoi = null , $HoTen = null , $NgaySinh = null , $DiaChi = null , $Sdt = null , $MaNV = null , $TaiKhoan = null){
        parent::__construct($MaNguoi , $HoTen , $NgaySinh , $DiaChi , $Sdt);
        $this->MaNV = $MaNV;
        $this->TaiKhoan = $TaiKhoan;
    }

    public function getMaNV(){
        return $this->MaNV;
    }
    public function getTaiKhoan(){
        return $this->TaiKhoan;
    }

    public function setMaNV($MaNV){
        $this->MaNV = $MaNV;
    }
    public function setTaiKhoan($TaiKhoan){
        $this->TaiKhoan=$TaiKhoan;
    }

    public static function getData(){
        $nhanviens = [];
        $sql = "SELECT NhanVien.MaNV,Nguoi.MaNguoi,TaiKhoan.TaiKhoan,Nguoi.HoTen,Nguoi.NgaySinh,Nguoi.DiaChi,Nguoi.Sdt,TaiKhoan.MatKhau,TaiKhoan.LoaiTK FROM NhanVien , Nguoi , TaiKhoan WHERE NhanVien.MaNguoi = Nguoi.MaNguoi AND NhanVien.TaiKhoan = TaiKhoan.TaiKhoan;";
        $db = Database::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $TaiKhoan = new TaiKhoan($row['TaiKhoan'],$row['MatKhau'],$row['LoaiTK']);
            $nhanviens[] = new NhanVien($row['MaNguoi'],$row['HoTen'],$row['NgaySinh'],$row['DiaChi'],$row['Sdt'],$row['MaNV'],$TaiKhoan);
        }

        return $nhanviens;
    }

    public static function getNhanVienbyID($id){
        $nhanvien = null;
        $sql = "SELECT NhanVien.MaNV,Nguoi.MaNguoi,TaiKhoan.TaiKhoan,Nguoi.HoTen,Nguoi.NgaySinh,Nguoi.DiaChi,Nguoi.Sdt,TaiKhoan.MatKhau,TaiKhoan.LoaiTK FROM NhanVien , Nguoi , TaiKhoan WHERE NhanVien.MaNguoi = Nguoi.MaNguoi AND NhanVien.TaiKhoan = TaiKhoan.TaiKhoan AND NhanVien.MaNV = '$id';";
        $db = Database::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $TaiKhoan = new TaiKhoan($row['TaiKhoan'],$row['MatKhau'],$row['LoaiTK']);
            $nhanvien = new NhanVien($row['MaNguoi'],$row['HoTen'],$row['NgaySinh'],$row['DiaChi'],$row['Sdt'],$row['MaNV'],$TaiKhoan);
        }

        return $nhanvien;
    }

    public function addNhanVien(){
        $db = Database::getInstance();
        // Tên của bảng
        $table = "NhanVien";
        $nguoi = new Nguoi($this->getMaNguoi(),$this->getHoTen(), $this->getNgaySinh(), $this->getDiaChi(),$this->getSdt());
        $taikhoan = new TaiKhoan($this->TaiKhoan->getTaiKhoan(),$this->TaiKhoan->getMatKhau(),$this->TaiKhoan->getLoaiTK());
        

        if ($taikhoan->addTaiKhoan() > 0){
            if ($nguoi->addNguoi() > 0){
                $nguoinew = $nguoi->getNguoinew();
                $data = array(
                    "MaNV" => $this->MaNV,
                    "TaiKhoan" => $taikhoan->getTaiKhoan(),
                    "MaNguoi" => $nguoinew->getMaNguoi(),
                );
                return $db->insert_data($table, $data);
            } else {
                // Xoa Tai khoan vừa tạo
                return -3;
            }
        } else {
            return -2;
        }
        
    }

    public function editNhanVien(){
        $nhanvien = NhanVien::getNhanVienbyID($this->MaNV);
        if ($nhanvien){
            $nguoi = new Nguoi($nhanvien->getMaNguoi(),$this->getHoTen(), $this->getNgaySinh(), $this->getDiaChi(),$this->getSdt());
            $taikhoan = new TaiKhoan($nhanvien->TaiKhoan->getTaiKhoan(),$this->TaiKhoan->getMatKhau(),$this->TaiKhoan->getLoaiTK());
            

            if ($taikhoan->editTaiKhoan() >= 0){
                if ($nguoi->editNguoi() >= 0){     
                    return 1;
                } else {
                    return -3;    
                }
            } else {
                return -2;
            }
        } else {
            return 0;
        }
        
    }

    public static function getNhanVienbyUser($username){
        $db = Database::getInstance();
        $sql = "SELECT * FROM NhanVien , Nguoi WHERE NhanVien.MaNguoi = nguoi.MaNguoi AND NhanVien.TaiKhoan = '$username'";
        return $db->getDatas($sql);
    }

    public function deleteNhanVien(){
        $db = Database::getInstance();
        $nhanvien = NhanVien::getNhanVienbyID($this->MaNV);
        if ($nhanvien){
            $table = "NhanVien";
            $where = "MaNV = '$this->MaNV'";
            $result = $db->delete_data($table, $where);
            if ($result >= 0){
                $taikhoan = $nhanvien->getTaiKhoan();
                if ($taikhoan->deleteTaiKhoan() >= 0){
                    return $nhanvien->deleteNguoi();
                } else {
                    return -3;
                }   
            } else {
                return -2;
            }
        } else {
            return -1;
        }
    }
}
?>