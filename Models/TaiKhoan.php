<?php
require_once 'Models/dbconfig.php';

class TaiKhoan {

    private $taikhoan;
    private $matkhau;
    public $loaitk;

    public function __construct($taikhoan , $matkhau , $loaitk){
        $this->taikhoan = $taikhoan;
        $this->matkhau = $matkhau;
        $this->loaitk = $loaitk;
    }

    function isValidUsername($username) {
        $pattern = "/^[a-zA-Z0-9]*$/";
        if (preg_match($pattern, $username)) {
            return true;
        } else {
            return false;
        }
    }
    


    public static function getByUsernameAndPassword($username, $password) {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM TaiKhoan WHERE TaiKhoan = :username AND MatKhau = :password');
        $stmt->execute([':username' => $username, ':password' => $password]);
    
        $result = $stmt->fetch();
        if ($result){
            $tk = $result['TaiKhoan'];
            $mk = $result['MatKhau'];
            $ltk = $result['LoaiTK'];
            $user = new TaiKhoan($tk ,$mk  , $ltk);
            return $user;
        } else {
            return NULL;
        }
    }

    public static function Login($username, $password) {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM TaiKhoan WHERE TaiKhoan = :username AND MatKhau = :password');
        $stmt->execute([':username' => $username, ':password' => $password]);
    
        $result = $stmt->fetch();
        if ($result){
            $sql = "SELECT * FROM NhanVien , TaiKhoan , Nguoi WHERE NhanVien.TaiKhoan = TaiKhoan.TaiKhoan AND NhanVien.MaNguoi = Nguoi.MaNguoi AND TaiKhoan.TaiKhoan = '$username';";
            $result2 = $db->getDatas($sql)->fetch();
            if ($result2){
                return $result2;
            } else {
                
                return $result;
            }
            
            
        } else {
            return NULL;
        }
    }
    
    public function getTaiKhoan(){
        return $this->taikhoan;
    }
    public function getMatKhau(){
        return $this->matkhau;
    }
    public function getLoaitk(){
        return $this->loaitk;
    }
    public function setTaiKhoan($TaiKhoan){
        $this->taikhoan = $TaiKhoan;
    }
    public function setMatKhau($matkhau){
        $this->matkhau = $matkhau;
    }
    public function setLoaitk($loaitk){
        $this->loaitk = $loaitk;
    }
    public static function getAllUser() {
        $db = Database::getInstance();
        $result = $db->getData('TaiKhoan');
        $users = [];

        while ($row = $result->fetch()) {
            $users[] = new TaiKhoan($row['TaiKhoan'], $row['MatKhau'], $row['LoaiTK']);
        }

        return $users;
    }

    public static function getUserbyID($TaiKhoan) {
        $user = $_SESSION['user'];
        if ($user == null) {
            return null;
        } else if ($user->getLoaitk() == '1') {
            return $user;
        }
        $db = Database::getInstance();
        $result = $db->getData('TaiKhoan','TaiKhoan', $TaiKhoan);
        $users = [];

        while ($row = $result->fetch()) {
            $users[] = new TaiKhoan($row['TaiKhoan'], $row['MatKhau'], $row['LoaiTK']);
        }

        return $users;
    }

    public static function getUserByuserName($TaiKhoan) {
        $db = Database::getInstance();
        $result = $db->getData('TaiKhoan','TaiKhoan', $TaiKhoan);


        while ($row = $result->fetch()) {
            return new TaiKhoan($row['TaiKhoan'], $row['MatKhau'], $row['LoaiTK']);
        }

        return null;
    }

    
    
    public function addTaiKhoan(){
        if (!$this->isValidUsername($this->taikhoan)) {
            return -10;
        }
        $db = Database::getInstance();

        // Tên của bảng
        $table = "TaiKhoan";

        // Mảng dữ liệu
        $data = array(
            "TaiKhoan" => $this->taikhoan,
            "MatKhau" => $this->matkhau,
            "LoaiTK" => $this->loaitk
        );

        // Gọi hàm thêm dữ liệu vào bảng
        return $db->insert_data($table, $data);
    }

    public function editTaiKhoan(){
        $db = Database::getInstance();

        // Tên của bảng
        $table = "TaiKhoan";

        // Mảng dữ liệu
        $data = array(
            "MatKhau" => $this->matkhau,
            "LoaiTK" => $this->loaitk
        );

        $where = "TaiKhoan = '$this->taikhoan'";
        // Gọi hàm thêm dữ liệu vào bảng
        return $db->update_data($table, $data, $where);
    }

    public function deleteTaiKhoan(){
        $db = Database::getInstance();
        
        $table = "TaiKhoan";
        $where = "TaiKhoan = '$this->taikhoan'";

        return $db->delete_data($table, $where);
    }

}
?>
