<?php
/**
 * 
 */
class AuthModel
{
	public function index()
	{
		require_once("View/auth/index.php");
	}

	public function login_aslab()
	{
		require_once("View/auth/login_aslab.php")
	}
	public function login_praktikan()
	{
		require_once("View/auth/login_praktikan.php")
	}
	public function daftarPraktikan()
	{
		require_once("View/auth/daftar_praktikan.php")
	}
	/**cek data dari database berdasarkan $npm dan $password*/
	public function prosesAuthAslab($npm,$password)
	{
		$sql= "SELECT * FROM aslab WHERE npm='$npm' and password='$password'";
		$query= koneksi()->query($sql);
		return $query ->fetch_assoc();
	}
	/**Authentication aslab*/
	public function AuthAslab()
	{
		$npm= $_POST['npm'];
		$password=$_POST['password']; 
		$data=$this->prosesAuthAslab($npm,$password);
		if ($data){
			$_SESSION['role']= 'aslab';
			$_SESSION['aslab']= $data;
			header("location:index.php?page=aslab$aksi=view$pesan=Berhasil Login");
		} else {
			header("location:index.php?page=auth$aksi=loginAslab$pesan=Password atau NPM anda Salah!!");
		}
	}
	/**cek data dari database berdasarkan $npm dan $password*/
	public function prosesAuthPraktikan($npm,$password)
	{
		$sql= "SELECT * FROM praktikan WHERE npm='$npm' and password='$password'";
		$query= koneksi()->query($sql);
		return $query ->fetch_assoc();
	}
	/**Authentication Praktikan*/
	public function AuthPraktikan()
	{
		$npm= $_POST['npm'];
		$password=$_POST['password']; 
		$data=$this->prosesAuthPraktikan($npm,$password);
		if ($data){
			$_SESSION['role']= 'aslab';
			$_SESSION['praktikan']= $data;
			header("location:index.php?page=praktikan$aksi=view$pesan=Berhasil Login");
		} else {
			header("location:index.php?page=auth$aksi=loginPraktikan$pesan=Password atau NPM anda Salah!!");
		}
	}
	/**logout*/
		public function logout()
		{
			session_destroy();
			header("location:index.php?page=auth$aksi=view$pesan=Berhasil LOGOUT !!");
		}
?>