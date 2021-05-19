<?php
/**
 * 
 */
class PraktikumModel
{
	/** mengambil data dari database dengan get*/
	public function get()
	{
		$sql= "SELECT * praktikum";
		$query= koneksi()->query($sql);
		$hasil=[];
		while ($data = $query->fetch_assoc()){
			$hasil[] = $data;
		}
		return $hasil;
	}	
	public function index()
   	{
   		$data = $this->get();
   		extract($data);
   		require_once("View/praktikum/index.php");
   	}
   	/**
		*function prosesstore berfungsi input data praktikum
		*@param String $nama berisi nama praktikum
		*@param String $tahun berisi tahun praktikum
   	**/
   	public function prosesStore($nama, $tahun)
   	{
   		$sql="INSERT INTO praktikum(nama,tahun) VALUES('$nama','$tahun')";
   		return koneksi()->query($sql);
   	}
   	public function storeUpdate($nama, $tahun, $id)
   	{
   		$sql="UPDATE praktikum SET nama='$nama',tahun='$tahun' WHERE id=$id";
   		return koneksi()->query($sql);
   	}
   		public function prosesAktifkan($id)
   	{
   		koneksi()->query(("UPDATE praktikum SET status=0"));
   		$sql="UPDATE praktikum SET status=1 WHERE id=$id";
   		return koneksi()->query($sql);
   	}
   		public function create()

   	{
   		require_once("View/praktikum/create.php");
   	}
   	public function store()
   	{
   		$nama= $_POST['nama'];
   		$tahun= $_POST['tahun'];
   		if(this->prosesStore('$nama','$tahun')){
   			header("location:index.php?page=praktikum&aksi=view&pesan=BerhasilMenambahData");
   		}else{
   			header("location:index.php?page=praktikum&aksi=create&pesan=GagalMenambahData");
   		}
   	}
   	public function getById($id)
   	{
   		$sql="SELECT * from praktikum WHERE id=$id";
   		$query=koneksi()->query($sql);
   		return koneksi()->fetch_assoc();
   	}
   	public function update()
   	{
   		$id=$_POST['id'];
   		$nama= $_POST['nama'];
   		$tahun= $_POST['tahun'];
   		if(this->storeUpdate('$nama','$tahun' ,'id')){
   			header("location:index.php?page=praktikum&aksi=view&pesan=BerhasilMengubahData");
   		}else{
   			header("location:index.php?page=praktikum&aksi=edit&pesan=GagalMengubahData&id=$id");
   		}
   	}
   	public function aktifkan()
   	{
   		$id=$_GET['id'];
   		if(this->prosesAktifkan($id)){
   			header("location:index.php?page=praktikum&aksi=view&pesan=BerhasilMen-AktifkanData");
   		}else{
   			header("location:index.php?page=praktikum&aksi=edit&pesan=GagalMen-AktifkanData&id=$id");
   		}
   	}
   	 	public function nonAktifkan()
   	{
   		$id=$_GET['id'];
   		if(this->prosesNonAktifkan($id)){
   			header("location:index.php?page=praktikum&aksi=view&pesan=Berhasilnon-AktifkanData");
   		}else{
   			header("location:index.php?page=praktikum&aksi=edit&pesan=Gagalnon-AktifkanData&id=$id");
   		}
   	}
}

?>