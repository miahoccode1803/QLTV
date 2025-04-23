<?php
    require_once "Models/dbconfig.php";
    class PhieuPhat{
        public $MaPP;
        public $MaPM;
        public $LyDo;

        public function __construct($MaPP, $MaPM, $LyDo) {
            $this->MaPP = $MaPP;
            $this->MaPM = $MaPM;
            $this->LyDo = $LyDo;
        }

        public static function getPPbyPM($MaPM) {
            $db = Database::getInstance();
            $result = $db->getData("PhieuPhat","MaPM" , $MaPM);
            
            while ($row = $result->fetch()){
                return new PhieuPhat($row['MaPP'] , $row['MaPM'] , $row["LyDo"]);
            }
            return null;
        }

        public function addPhieuPhat() {
            $db = Database::getInstance();
            $table = "PhieuPhat";
            $data = array(
                "MaPP"=> $this->MaPP,
                "MaPM"=> $this->MaPM,
                "LyDo"=> $this->LyDo
            );
            return $db->insert_data($table, $data);
        }

        public function deletePhieuPhat() {
            $db = Database::getInstance();
            $table = "PhieuPhat";
            $where = "MaPP = '$this->MaPP'";
            return $db->delete_data($table, $where);
        }
    }
?>