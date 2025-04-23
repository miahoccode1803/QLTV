<?php
    require_once "Models/dbconfig.php";
    class DauSach{
        private $MaDS;
        private $TenDS;
        private $SoLuong;
        private $TenTG;
        private $TheLoai;
        

        public function __construct($MaDS, $TenDS, $SoLuong, $TenTG, $TheLoai){
            $this->MaDS = $MaDS;
            $this->TenDS = $TenDS;
            $this->SoLuong = $SoLuong;
            $this->TenTG = $TenTG;
            $this->TheLoai = $TheLoai;
        }

        public function getMaDS(){
            return $this->MaDS;
        }
        public function getTenDS(){
            return $this->TenDS;
        }
        public function getSoLuong(){
            return $this->SoLuong;
        }
        public function getTenTG(){
            return $this->TenTG;
        }
        public function getTheLoai(){
            return $this->TheLoai;
        }
        public function setMaDS($MaDS){
            $this->MaDS = $MaDS;
        }
        public function setTenDS($TenDS){
            $this->TenDS = $TenDS;
        }
        public function setSoLuong($SoLuong){
            $this->SoLuong = $SoLuong;
        }
        public function setTenTG($TenTG){
            $this->TenTG = $TenTG;
        }
        public function setTheLoai($TheLoai){
            $this->TheLoai = $TheLoai;
        }

        public static function getSachs($MaDS){
            $db = Database::getInstance();
            $table = "Sach";
            $field = "MaDS";
            $result = $db->getData($table , $field , $MaDS);
            $sachs = [];
            while($row = $result->fetch()){
                $sachs[] = new Sach($row['MaSach'] , $row['MaDS'] , $row['TrangThai']);
            }
            return $sachs;
        }

        public static function getDS($MaDS){
            $db = Database::getInstance();
            $sql = "SELECT * FROM `DauSach`,`TheLLoai` WHERE DauSach.MaTL = TheLLoai.MaTL AND DauSach.MaDS = '$MaDS'";

            $result = $db->getDatas($sql);
            while($row = $result->fetch()){
                return new DauSach($row['MaDS'] , $row['TenDS'] , $row['SoLuong'] , $row['TenTG'] , new TheLoai( $row['MaTL'] , $row['TenTL']));
            }
            return null;
        }

        public static function getDSs(){
            $db = Database::getInstance();
            $sql = "SELECT * FROM `DauSach`,`theloai` WHERE DauSach.MaTL = theloai.MaTL";

            $result = $db->getDatas($sql);
            $sds = [];
            while($row = $result->fetch()){
                $sds[] = new DauSach($row['MaDS'] , $row['TenDS'] , $row['SoLuong'] , $row['TenTG'] , new TheLoai( $row['MaTL'] , $row['TenTL']));
            }
            return $sds;
        }

        public function addDauSach(){
            $db = Database::getInstance();
            $table = "DauSach";
            $data = array(
                "TenDS"=>$this->TenDS,
                "SoLuong"=> 0,
                "TenTG" => $this->TenTG,
                "MaTL" => $this->TheLoai->getMaTL()
            );
            return $db->insert_data($table, $data);
        }

        public function editDauSach(){
            $db = Database::getInstance();
            $table = "DauSach";
            $data = array(
                "TenDS"=>$this->TenDS,
                "TenTG" => $this->TenTG,
                "MaTL" => $this->TheLoai->getMaTL()
            );
            $where = "MaDS = $this->MaDS";
            return $db->update_data($table, $data , $where);
        }

        public function updateDauSach(){
            $db = Database::getInstance();
            $table = "DauSach";
            $data = array(
                "SoLuong"=>$this->SoLuong,
            );
            $where = "MaDS = $this->MaDS";
            return $db->update_data($table, $data , $where);
        }

        public function deleteDauSach(){
            $db = Database::getInstance();
            $sachs = DauSach::getSachs($this->MaDS);
            foreach($sachs as $sach){
                $sach->deleteSach();
            }

            $table = "DauSach";
            $where = "MaDS = '$this->MaDS'";

            return $db->delete_data( $table , $where);
        }

    }
?>