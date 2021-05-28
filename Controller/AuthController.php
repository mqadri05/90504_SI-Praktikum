<?php
/**
 * 
 */
class AuthController{
	private $model;
	public function __contruct(){
		$this->model= new Authmodel
	}

	public function authPraktikan(){
		$npm = $_POST['npm'];
		$password = $_POST['password'];
		$data = $this ->model->prosesAuthPraktikan($npm, $password);
		
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