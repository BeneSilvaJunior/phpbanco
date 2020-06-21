  <?php
  require_once("config.php"); 
 
  $root = new Usuario();  
  $root->loadbyId(3);
  
  //Chama o método __toString()
  echo $root;
  
  /*
  $sql = new Sql();  
  $usuarios = $sql->select("SELECT * FROM tb_usuarios");
  */
  
  echo json_encode($usuarios); 
  ?>