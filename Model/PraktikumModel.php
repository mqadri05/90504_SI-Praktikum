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
}

?>