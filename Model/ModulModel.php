<?php
/**
 * 
 */
class ModulModel
{
	public function get(){
		$sql ="SELECT modul.id as id,praktikum.status as status, modul.nama as nama FROM modul JOIN praktikum ON modul.praktikum_id = praktikum.id WHERE praktikum.status = 1";
		$query = koneksi()->query($sql);
		$hasil= [];
		while($data = $query -> fetch_assoc()){
		 $hasil[]=$data;
		}
		return $hasil;
	}
	public function index(){
		$data = $this->get();
		extract($data);
		require_one("View/modul/index.php");
	}
		/**
		*function prosesstore berfungsi input data praktikum
		*@param String $modul berisi nama modul praktikum
		*@param String $idPraktikum berisi id praktikum
   	**/
   	public function prosesStore($modul, $idPraktikum)
   	{
   		$sql="INSERT INTO modul(nama,praktikum_id) VALUES('$modul','$idPraktikum')";
   		return koneksi()->query($sql);
   	}
   	public function prosesDelete($id)
   	{
   		$sql="DELETE FROM modul WHERE id=$id";
   		return koneksi()->query($sql);
   	}
   	public function getPraktikum()
   	{
   		$sql="SELECT * from praktikum WHERE status=1";
   		$query=koneksi()->query($sql);
   		$hasil= [];
   		while ($data= $query->fetch_assoc()){
   			$hasil[]= $data;
   		}
   		return $hasil;
   	}
   	public function create()

   	{
   		$data= $this->getPraktikum();
   		extract($data);
   		require_once("View/modul/create.php");
   	}
   	public function store()
   	{
   		$modul= $_POST['modul'];
   		$praktikum= $_POST['praktikum'];
   		$getLastData = $this->getLastData();
   		if(getLastData== null) {
   			for($i=1;$i= <= $modul; $i++){
   				$nama = 'Modul'.$i;
   				$post = $this->prosesStore($nama,$praktikum);
   			}
   	}
   	else {
   		$modulLast= explode(" ", $getLastData['nama']);
   		for($i=1;$i= <= $modul; $i++){
   				$a = $modulLast['1'] +=1;
   				$nama = 'Modul' . $a;
   				$post = $this->prosesStore($nama,$praktikum);
   			}
   	}
   		if ($post){
   			header("location:index.php?page=modul&aksi=view&pesan=BerhasilMenambahData");
   		}
   		else {
   			header("location:index.php?page=modul&aksi=create&pesan=GagalMenambahData");
   		}
   }
   public function delete()
   	{
   		$id=$_GET['id'];
   		if(this->prosesDelete($id)){
   			header("location:index.php?page=modul&aksi=view&pesan=BerhasilDeleteData");
   		}else{
   			header("location:index.php?page=modul&aksi=view&pesan=GagalDeleteData");
   		}
   	}
}
?>