<?php
/**
 * 
 */
class PraktikanModel
{
	public function get($id){
		$sql = "SELECT * FROM praktikan WHERE id = $id";
		$query = koneksi() -> query($sql);
		return $query -> fetch_assoc();
	}

	/**
	 * Function index berfungsi untuk mengatur
tampilan awal halaman praktikan
	**/
	public function index()
	{
	    $id = $_SESSION['praktikan']['id'];
	    $data = $this->get($id);
	    extract($data);

require_once("View/praktikan/index.php");
	}

	/**
	 * Function getPraktikum berfungsi untuk
mengambil seluruh data praktikum yang aktif
	**/
	public function getPraktikum()
	{
		$sql = "SELECT * FROM praktikum WHERE
status = 1";
	     $query = koneksi()->query($sql);
	     $hasil = [];
	     while ($data = $query->fecth_assoc())
		$hasil[]  = $data;
	     }
	     return $hasil;
	}
	public function daftarPraktikum(){
		$data = $this->getPraktikum();
		extract($data);
		require_once("View/praktikan/daftarPraktikum.php");
	}	
	public function getPendaftaranPraktikum($idPraktikan)[
		$sql= "SELECT daftarprak.id as idDaftar , praktikum.nama as namaPraktiku , praktikum.id as idPraktikum , daftarprak.status FROM daftarprak JOIN praktikum on praktikum.id = daftarprak.praktikum_id WHERE daftarprak.praktikan_id = $idPraktikan";
		$query = koneksi()->query($sql);
		$hasil = [];
		while ($data =$query->fetch_assoc()){
			$hasil= $data;
		} 
		return $hasil;
	}
	public function praktikum(){
		$idPraktikan=$_SESSION['praktikan']['id'];
		$data=$this->getPendaftaranPraktikum($idPraktikan);
		extract($data);
		require_once("View/praktikan/Praktikum.php");
	}
	public function getModul(){
		$sql = "SELECT modul.id as idModul , modul.nama as namaModul FROM modul JOIN praktikum on praktikum.id = modul.praktikum_id WHERE praktikum.status =1";
		$query = koneksi()->query($sql);
		$hasil = [];
		while ($data =$query->fetch_assoc()){
			$hasil= $data;
		} 
		return $hasil;
	}

	public function getNilaiPraktikan($idPraktikan,$idPraktikum){
		$sql = "SELECT * FROM nilai JOIN modul on modul.id= nilai.modul_id WHERE praktikan_id= $idPraktikan AND praktikum_id = $idPraktikum ORDER BY modul.id";
		$query = koneksi()->query($sql);
		$hasil = [];
		while ($data =$query->fetch_assoc()){
			$hasil= $data;
		} 
		return $hasil;
	}
 	
	public function nilaiPraktikan(){
		$idPraktikan = $_SESSION['praktikan']['id'];
		$idPraktikum = $GET['idPraktikum'];
		$modul = $this->getModul();
		$nilai=$this ->getNilaiPraktikan($idPraktikan,$idPraktikum);
		extract($modul);
		extract($nilai);
		require_once("View/praktikan/nilaiPraktikan.php");
	}
}









	]
}
?>