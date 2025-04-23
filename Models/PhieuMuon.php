<?php 
    require_once "Models/dbconfig.php";
    require_once "Models/ChiTietPhieuMuon.php";
    require_once "Models/NhanVien.php";
	require_once "Models/PhieuPhat.php";
    class PhieuMuon{
        private $MaPM;
	    private $MaTTV;
	    private $MaNV;
	    private $NgayMuon;
	    private $NgayTra;
	    private $LuaChon;
	    private $TrangThai;
        private $PhieuPhat;
    
	/**
	 * @return mixed
	 */
	public function getMaPM() {
		return $this->MaPM;
	}
	
	/**
	 * @param mixed $MaPM 
	 * @return self
	 */
	public function setMaPM($MaPM): self {
		$this->MaPM = $MaPM;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getMaTTV() {
		return $this->MaTTV;
	}
	
	/**
	 * @param mixed $MaTTV 
	 * @return self
	 */
	public function setMaTTV($MaTTV): self {
		$this->MaTTV = $MaTTV;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getMaNV() {
		return $this->MaNV;
	}
	
	/**
	 * @param mixed $MaNV 
	 * @return self
	 */
	public function setMaNV($MaNV): self {
		$this->MaNV = $MaNV;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getNgayMuon() {
		return $this->NgayMuon;
	}
	
	/**
	 * @param mixed $NgayMuon 
	 * @return self
	 */
	public function setNgayMuon($NgayMuon): self {
		$this->NgayMuon = $NgayMuon;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getNgayTra() {
		return $this->NgayTra;
	}
	
	/**
	 * @param mixed $NgayTra 
	 * @return self
	 */
	public function setNgayTra($NgayTra): self {
		$this->NgayTra = $NgayTra;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getLuaChon() {
		return $this->LuaChon;
	}
	
	/**
	 * @param mixed $LuaChon 
	 * @return self
	 */
	public function setLuaChon($LuaChon): self {
		$this->LuaChon = $LuaChon;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getTrangThai() {
		return $this->TrangThai;
	}
	
	/**
	 * @param mixed $TrangThai 
	 * @return self
	 */
	public function setTrangThai($TrangThai): self {
		$this->TrangThai = $TrangThai;
		return $this;
	}

    public function __construct($MaPM , $MaTTV , $MaNV , $NgayMuon , $NgayTra , $LuaChon , $TrangThai) {
        $this->MaPM = $MaPM;
        $this->MaTTV = $MaTTV;
        $this->MaNV = $MaNV;
        $this->NgayMuon = $NgayMuon;
        $this->NgayTra = $NgayTra;
        $this->LuaChon = $LuaChon;
        $this->TrangThai = $TrangThai;
    }

    public static function getPhieuMuonNew() {
        $db = Database::getInstance();
        $phieumuon = null;
        $sql = "SELECT * FROM `PhieuMuon` WHERE MaPM IN (SELECT Max(MaPM) AS MaPM FROM PhieuMuon)";
        $result = $db->getDatas($sql);
        while ($row = $result->fetch()) {
            $phieumuon = new PhieuMuon($row['MaPM'] , $row['MaTTV'] ,$row['MaNV'], $row['NgayMuon'] , $row['NgayTra'] , $row['LuaChon'] , $row['TrangThai']);
        }
        return $phieumuon;
    }

	public static function getPhieuMuon() {
        $db = Database::getInstance();
        $phieumuon = [];
        $table = "PhieuMuon";
        $result = $db->getData($table);
        while ($row = $result->fetch()) {
            $pm = new PhieuMuon($row['MaPM'] , $row['MaTTV'] ,$row['MaNV'], $row['NgayMuon'] , $row['NgayTra'] , $row['LuaChon'] , $row['TrangThai']);
			$pm->checkPhieuMuon();
			$phieumuon[] = $pm;
        }
        return $phieumuon;
    }

	public static function getPMbyDG($MaTTV) {
		$db = Database::getInstance();
		$phieumuon = [];
		$table = "PhieuMuon";
		$field = "MaTTV";
        $result = $db->getData($table, $field, $MaTTV);
        while ($row = $result->fetch()) {
            $pm = new PhieuMuon($row['MaPM'] , $row['MaTTV'] ,$row['MaNV'], $row['NgayMuon'] , $row['NgayTra'] , $row['LuaChon'] , $row['TrangThai']);
			$pm->checkPhieuMuon();
			$phieumuon[] = $pm;
        }
        return $phieumuon;
	}

	public static function getPhieuMuonbyID($id) {
        $db = Database::getInstance();
        $table = "PhieuMuon";
		$field = "MaPM";
        $result = $db->getData($table, $field, $id);
        while ($row = $result->fetch()) {
            return new PhieuMuon($row['MaPM'] , $row['MaTTV'] ,$row['MaNV'], $row['NgayMuon'] , $row['NgayTra'] , $row['LuaChon'] , $row['TrangThai']);
        }
        return null;
    }

	public function getCTPM() {
		$db = Database::getInstance();
		$table = "ChiTietPhieuMuon";
		$field = "MaPM";
		$result = $db->getData($table, $field,$this->MaPM);
		$ct = [];
		while ($row = $result->fetch()) {
			$ct[] = new ChiTietPhieuMuon($row["MaPM"] , $row["MaSach"]);
		}
		return $ct;
	}

	public function addPhieuMuon(){
		$db = Database::getInstance();
		$table = "PhieuMuon";
		$data = array(
			"MaTTV"=> $this->MaTTV,
			"MaNV"=> $this->MaNV,
			"NgayMuon"=> $this->NgayMuon,
			"NgayTra"=> $this->NgayTra,
			"LuaChon"=> $this->LuaChon,
			"TrangThai"=> $this->TrangThai
		);
		return $db->insert_data($table, $data);
	}

	public function updatePhieuMuon(){
		$db = Database::getInstance();
		$table = "PhieuMuon";
		$data = array(
			"MaTTV"=> $this->MaTTV,
			"MaNV"=> $this->MaNV,
			"NgayMuon"=> $this->NgayMuon,
			"NgayTra"=> $this->NgayTra,
			"LuaChon"=> $this->LuaChon,
			"TrangThai"=> $this->TrangThai
		);

		$where = "MaPM = $this->MaPM";
		return $db->update_data($table, $data, $where);
	}

	public function checkPhieuMuon(){
		
		if ($this->TrangThai == "Đang mượn" && $this->NgayTra < date("Y-m-d",time())){
			$this->TrangThai = "Quá hạn";
			return $this->updatePhieuMuon();
		}
	}

	public function painPhieuMuon(){
		$this->TrangThai = "Đã hoàn thành";
		$result =  $this->updatePhieuMuon();
		if ($result > 0){
			$ct = $this->getCTPM();

			foreach ($ct as $pm) {
				$sach = Sach::getSachbyID($pm->getMaSach());
				if ($sach) {
					$sach->painSach();
				}
			}
		}
	}

	public function createPP(){
		$phieuphat = PhieuPhat::getPPbyPM($this->MaPM);
		if ($phieuphat) {
			$this->TrangThai = "Đã phạt";
		} else {
			return;
		}
		
		
		$result =  $this->updatePhieuMuon();
		if ($result > 0){
			$ct = $this->getCTPM();

			foreach ($ct as $pm) {
				$sach = Sach::getSachbyID($pm->getMaSach());
				if ($sach) {
					$sach->painSach();
				}
			}
		}
	}

	public function deletePM(){
		$db = Database::getInstance();

		$ct = $this->getCTPM();

		foreach ($ct as $pm) {
			$sach = Sach::getSachbyID($pm->getMaSach());
			if ($sach) {
				$sach->painSach();
			}

			$pm->deleteCTPM();
		}
		$pp = PhieuPhat::getPPbyPM($this->MaPM);
		if ($pp) {
			$result = $pp->deletePhieuPhat();
			if ($result > 0){
				$table = "PhieuMuon";
				$where = "MaPM = '$this->MaPM'";
				return $db->delete_data($table, $where);
			}
		} else {
			$table = "PhieuMuon";
			$where = "MaPM = '$this->MaPM'";
			return $db->delete_data($table, $where);
		}

		return -1;
	}

	public function check_pp(){
		$db = Database::getInstance();
		$sql = "SELECT * FROM PhieuMuon WHERE PhieuMuon.MaTTV = '$this->MaTTV' AND PhieuMuon.TrangThai = 'Quá hạn'";
		$result = $db->getDatas($sql);
		if ($result){
			return true;
		} else {
			return false;
		}
	}

}
?>