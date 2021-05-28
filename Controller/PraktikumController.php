<?php
/**
 * 
 */
class PraktikumController{private $model;
	public funtion __construct();{
		$this->model= new PraktikumModel();   
	}

	public function index(){
		$idAslab = $_SESSION['aslab']['id'];
		$data = $this ->model->get($idAslab);
		extract($data);
		require_once("View/aslab/index.php")
	}
	public function nilai()
	{
		$idPraktikan = $_Get['id'];
		$modul =$this -> model->getModul();
		$nilai =$this ->model->getNilaiPraktikan($idPraktikan);
		extract($modul);
		extract($nilai);
		require_once("View/aslab/nilai.php")
	}
	public function createNilai()
	{
		$modul= $this ->model_>getModul();
		extract($modul);
		require_once("View/aslab/createNilai.php");
	}
	public function storeNilai(){
		$idModul= $_POST['modul'];
		$idPraktikan = $_GET['id'];
		$nilai = $_POST['nilai'];
		if ($this->model->prosesStoreNilai($idModul, $idPraktikan, $nilai)){
			header("location:index.php?page=aslab&aksi=nilai&pesan=Berhasil Tambah Data&id=$idPraktikan");
		}else{
			header("location:index.php?page=aslab&aksi=createNilai&pesan=Gagal Tambah Data&id=$idPraktikan");
		}
	}
} 

} 


?>