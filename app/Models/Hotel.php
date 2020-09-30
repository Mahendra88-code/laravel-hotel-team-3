<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use PDO;

class Hotel extends Model
{
	public function getTersedia()
	{
		$pdo = DB::getPdo();

		$sql = "SELECT COUNT(*) as jumlah FROM kamar WHERE status_kamar LIKE '%TERSEDIA%'";

		$statement = $pdo->prepare($sql);
		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_OBJ);
	}  

	public function getKotor()
	{
		$pdo = DB::getPdo();

		$sql = "SELECT COUNT(*) as jumlah FROM kamar WHERE status_kamar LIKE '%KOTOR%'";

		$statement = $pdo->prepare($sql);
		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_OBJ);
	}

	public function getTerpakai()
	{
		$pdo = DB::getPdo();

		$sql = "SELECT COUNT(*) as jumlah FROM kamar WHERE status_kamar LIKE '%TERPAKAI%'";

		$statement = $pdo->prepare($sql);
		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_OBJ);
	}

	public function getKamar()
	{
		$pdo = DB::getPdo();

		$sql = "SELECT * FROM kamar JOIN kamar_tipe ON kamar.id_kamar_tipe = kamar_tipe.id_kamar_tipe";

		$statement = $pdo->prepare($sql);
		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_OBJ);
	}

	public function getLayanan()
	{
		$pdo = DB::getPdo();

		$sql = "SELECT * FROM layanan JOIN layanan_kategori ON layanan.id_layanan_kategori = layanan_kategori.id_layanan_kategori";

		$statement = $pdo->prepare($sql);
		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_OBJ);
	}

	public function getKLayanan()
	{
		$pdo = DB::getPdo();

		$sql = "SELECT * FROM layanan_kategori ";

		$statement = $pdo->prepare($sql);
		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_OBJ);
	}

	public function getTKamar()
	{
		$pdo = DB::getPdo();

		$sql = "SELECT * FROM kamar_tipe ";

		$statement = $pdo->prepare($sql);
		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_OBJ);
	}

	public function getTransKamar()
	{
		$pdo = DB::getPdo();

		$sql = "SELECT * FROM transaksi_kamar as trans JOIN user ON trans.id_user = user.id_user JOIN tamu ON trans.id_tamu = tamu.id_tamu JOIN kamar ON trans.id_kamar = kamar.id_kamar ";

		$statement = $pdo->prepare($sql);
		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_OBJ);
	}

	public function getTransLayanan()
	{
		$pdo = DB::getPdo();

		$sql = "SELECT * FROM transaksi_layanan as trans JOIN user ON trans.id_user = user.id_user JOIN transaksi_kamar as tkamar ON trans.id_transaksi_kamar = tkamar.id_transaksi_kamar JOIN layanan ON trans.id_layanan = layanan.id_layanan_kategori ";

		$statement = $pdo->prepare($sql);
		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_OBJ);
	}

	public function getUser()
	{
		$pdo = DB::getPdo();

		$sql = "SELECT * FROM user JOIN user_role ON user.id_user_role = user_role.id_user_role ";

		$statement = $pdo->prepare($sql);
		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_OBJ);
	}

	public function getTamu()
	{
		$pdo = DB::getPdo();

		$sql = "SELECT * FROM tamu ";

		$statement = $pdo->prepare($sql);
		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_OBJ);
	}
}
