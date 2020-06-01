<?php
class Main{

         //fetch all posts
 public function get_all_posts(){
  global $pdo;

  $query = $pdo->prepare('SELECT * FROM users order by id desc');
  $query->execute([':id'=>$pid]);

  return $query->fetchAll(PDO::FETCH_ASSOC);
 }
  //fetch post data by post id 
  public function fetch_data($pid){
  global $pdo;

  $query = $pdo->prepare('SELECT * FROM users where post_id = ? order by id desc');
  $query->BindValue(1,$pid);
  $query->execute();

  return $query->fetch();
 }
  //check if user is logged in 
  public function logged_in(){
    return (isset($_SESSION['loggedin'])) ? true : false;
  }
}
?>