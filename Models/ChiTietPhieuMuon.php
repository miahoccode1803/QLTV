<?php
    require_once "Models/dbconfig.php";
    require_once "Models/Sach.php";
    class ChiTietPhieuMuon{
        private $MaPM;
        private $MaSach;


        public function __construct($MaPM , $MaSach) {
            $this->MaPM = $MaPM;
            $this->MaSach = $MaSach;
        }

        public function getMaPM() {
            return $this->MaPM;
        }
        public function getMaSach() {
            return $this->MaSach;
        }
        public function setMaSach($MaSach) {
            $this->MaSach = $MaSach;
        }
        public function setMaPM($MaPM) {
            $this->MaPM = $MaPM;
        }

        public function addCTPM() {
            $db = Database::getInstance();
            $table = "ChiTietPhieuMuon";
            $sach = Sach::getSachbyID($this->MaSach);
            if ($sach->getTrangThai() != 1) {
                return -10;
            }

            $data = array(
                "MaPM"=> $this->MaPM,
                "MaSach"=> $this->MaSach
            );
            $result = $db->insert_data($table, $data);
            if ($result > 0) {
                $sach->setTrangThai(0);
                $sach->editSach();
            }
        }

        public function deleteCTPM() {
            $db = Database::getInstance();
            $table = "ChiTietPhieuMuon";
            $where = "MaPM = '$this->MaPM' AND MaSach = '$this->MaSach'";
            return $db->delete_data($table, $where);
        }

        public function getSach() {
            return Sach::getSachbyID($this->MaSach);
        }
    }
?>