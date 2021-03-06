<?php 
class Main{

	public function get_all_posts(){
		global $pdo;

		$query = $pdo->prepare('SELECT * FROM users order by id desc');
		$query->execute();

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

		public function fetch_data($pid){
		global $pdo;

		$query = $pdo->prepare('SELECT * FROM users where id = ? order by id desc');
		$query->BindValue(1,$pid);
		$query->execute();

		return $query->fetch();
	}
}

//hello
class Order{

	public function get_all_products(){
		global $pdo;

		$query = $pdo->prepare('SELECT * FROM products order by id desc');
		$query->execute();

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

		public function fetch_product($pid){
		global $pdo;

		$query = $pdo->prepare('SELECT * FROM products where id = ? order by id desc');
		$query->BindValue(1,$pid);
		$query->execute();

		return $query->fetch();
	}
}

?>