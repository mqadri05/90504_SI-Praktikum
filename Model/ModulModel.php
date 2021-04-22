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
}
?>