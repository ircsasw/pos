<?php

require_once 'DbConnect.php';

/**
 *
 */
class Users
{
	public $table = 'users';

	static public function findUser($item, $value)
	{
		$stmt = DbConnect::connect()->prepare(
			'SELECT * FROM users WHERE ' . $item . ' = :value'
		);

		$stmt->bindParam(':value', $value, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();
	}

	static public function addUser($datos)
	{
		$stmt = DbConnect::connect()->prepare(
			'INSERT INTO users (name, user, password, profile, photo, status, last_login)
			VALUES (:name, :user, :password, :profile, "", 1, "0000-00-00")'
		);

		$stmt->bindParam(':name', $datos['nombre'], PDO::PARAM_STR);
		$stmt->bindParam(':user', $datos['usuario'], PDO::PARAM_STR);
		$stmt->bindParam(':password', $datos['password'], PDO::PARAM_STR);
		$stmt->bindParam(':profile', $datos['perfil'], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return true;
		} else {
			print_r($stmt->errorInfo()); die();
			return false;
		}
	}
}
