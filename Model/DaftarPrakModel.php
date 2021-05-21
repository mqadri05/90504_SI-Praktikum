<?php
/**
 * 
 */
class DaftarPrakModel
{
	public function get()
	{
		$sql="SELECT daftarprak.id ad idDaftar, daftarprak.praktikan_id as id_Praktikan,praktikan.nama as namaPraktikan,daftarprak.status as status,praktikum.nama as namaPraktikan JOIN praktikan ON praktikan.id = daftarprak.praktikan_id JOIN praktikum ON praktikum.id = daftarprak.praktikum_id WHERE praktikum.status = 1";
		$query = koneksi() -> query($sql);
		$hasil = [];
		while($data =$query->fetch_assoc())
		{
		$hasil = $data;
		}	
	return $hasil;
	}
	/**
		*function prosesstore berfungsi update status database telah diverifikasi
		*@param integer $id berisi id praktikum
		*@param integer $idaslab berisi id aslab praktikum
   	**/
   	public function prosesVerif($id, $idAslab)
   	{
   		$sql="UPDATE daftarprak SET status=1 ,aslab_id = $idAslab WHERE id= $id";
   		$query = koneksi()->query($sql);
   		return $query;

   	}
   	public function prosesUnVerif($id, $idPraktikan)
   	{
   		$sqlDelete="DELETE FROM nilai WHERE praktikan_id= $idPraktikan";
   		koneksi()->query($sqlDelete);
   		$sqlUpdate = "UPDATE daftarprak SET status=0 ,aslab_id = NULL WHERE id= $id";
   		$query = koneksi()->query($sqlUpdate);
   		return $query;
   	}
   	public function verif()
   	{
   		$id=$_GET['id'];
   		$idAslab= $_SESSION['aslab']['id'];
   		if(this->prosesVerif('$id','$idAslab')){
   			header("location:index.php?page=daftarprak&aksi=view&pesan=BerhasilVerifPraktikan");
   		}else{
   			header("location:index.php?page=daftarprak&aksi=view&pesan=GagalVerifPraktikan");
   		}
   	}
   	public function unVerif()
   	{
   		$id=$_GET['id'];
   		$idPraktikan= $$_GET['idPraktikan'];
   		if(this->prosesUnVerif('$id','$idPraktikan')) {
   			header("location:index.php?page=daftarprak&aksi=view&pesan=BerhasilUn-VerifPraktikan");
   		}else{
   			header("location:index.php?page=daftarprak&aksi=view&pesan=GagalUn-VerifPraktikan");
   		}
   	}
}
?>