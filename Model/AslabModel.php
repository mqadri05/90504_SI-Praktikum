<?php
/**
 * 
 */
class AslabModel
{
	/** mengambil data dari database dengan get*/
	public function get($idAslab)
	{
		$sql= "SELECT praktikan.id as idPraktikan , praktikan.nama as namaPraktikan , praktikan.npm as npmPraktikan , praktikan.nomor_hp as nohpPraktikan , praktikum.nama as namaPraktikum FROM praktikan
			JOIN daftarprak ON daftarprak.praktikan_id= praktikan.id
			WHERE daftarprak.status = 1
			AND daftarprak.aslab_id = $idAslab
			AND praktikum.status = 1
			";
		$query= koneksi()->query($sql);
		$hasil=[];
		while ($data = $query->fetch_assoc()){
			$hasil[] = $data;
		}
		return $hasil;
	}	
  /** mengatur tampilan awal*/
   	public function index()
   	{
   		$idAslab = $SESSION['aslab']['id'];
   		$data = $this->get($idAslab);
   		extract($data);
   		require_once("View/aslab/index.php");
   	}
   	/** getModul utk mengambil seluruh data modul*/
   	public function getModul()
   	{
   		$sql = "SELECT modul.id as idModul , modul.nama as namaModul FROM modul
			JOIN praktikum on praktikum.id= modul.praktikum_id
			WHERE praktikum.status = 1";
		$query= koneksi()->query($sql);
		$hasil=[];
		while ($data = $query->fetch_assoc()){
			$hasil[] = $data;
		}
		return $hasil;
   	}
   	/** getnilaipraktikan utk mengambil seluruh data nilai praktikan*/
   	public function getNilaiPraktikan($idPraktikan)
   	{
   		$sql ="SELECT * FROM nilai JOIN modul on modul.id=nilai.modul_id WHERE praktikan_id = $idPraktikan ORDER BY modul.id";
   		$query =koneksi() -> query($sql);
   		while ($data = $query->fetch_assoc()){	
   		$hasil[] = $data;
		}
		return $hasil; 
   	}
   	/** function nilai utk mengambil tampilan halaman data nilai praktikan*/
   	public function nilai()
   	{
   		$idPraktikan = $_GET['id'];
   		$modul = $this-> getmodul();
   		$nilai = $this-> getNilaiPraktikan($idPraktikan);
   		extract($modul);
   		extract($nilai);
   		require_once("View/aslab/nilai.php");
   	}

}
?>