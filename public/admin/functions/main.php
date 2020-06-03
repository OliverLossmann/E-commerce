<?php
class Main{

         //fetch all posts
 public function get_all_posts(){
  global $pdo;

  $query = $pdo->prepare('SELECT * FROM users order by id desc');
  $query->execute();

  return $query->fetchAll(PDO::FETCH_ASSOC);
 }
  //fetch post data by post id 
  public function fetch_data($pid){
  global $pdo;

  $query = $pdo->prepare('SELECT * FROM users where id = ? order by id desc');
  $query->BindValue(1,$pid);
  $query->execute();

  return $query->fetch();
 }
}

class Order{

         //fetch all posts
 public function get_all_products(){
  global $pdo;

  $query = $pdo->prepare('SELECT * FROM products order by id desc');
  $query->execute();

  return $query->fetchAll(PDO::FETCH_ASSOC);
 }
  //fetch post data by post id 
  public function fetch_product($pid){
  global $pdo;

  $query = $pdo->prepare('SELECT * FROM products where post_id = ? order by id desc');
  $query->BindValue(1,$pid);
  $query->execute();

  return $query->fetch();
 }
}
?>