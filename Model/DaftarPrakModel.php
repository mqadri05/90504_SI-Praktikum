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
		while($data =$query->fetch_assoc()){
		$hasil = $data;
	}	
	return $hasil;
}
?>