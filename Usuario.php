<?php
 
 class Usuario {
	 
	 private $idusuario;
	 private $deslogin;
	 private $dessenha;
	 private $dtcadastro;
	 
	 public function getIdusuario() {
		 return $this->idusuario;
	 }
	 
	 public function setIdusuario($value) {
		 $this->idusuario = $value;
	 }
	 
	 public function getdeslogin() {
		 return $this->deslogin;
	 }
	 
	 public function setDeslogin($value) {
		 $this->deslogin = $value;
	 }
	 
	 public function getDessenha() {
		 return $this->dessenha;
	 }
	 
	 public function setDessenha($value) {
		 $this->dessenha = $value;
	 }
	 
	 public function getDtcadastro() {
		 return $this->dtcadastro;
	 }
	 
	 public function setDtcadastro($value) {
		 $this->dtcadastro = $value;
	 }
	 
	 public function loadById($id) {
	 
	  $sql = new Sql();
	  
	  $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
	  	":ID"=>$id
	  ));
	  
	  if(count($results) > 0) {	  
		  $this->setData($results[0]);	  
	 }	 
 }
 
 //Traz uma lista de usuários
 public static function getList(){
  $sql = new Sql();
  return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
 }
 
 //Pesquisa usuários com base em uma letra ou palavra
 public static function search($login){
	 $sql = new Sql();
	 return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
	 ':SEARCH'=>"%".$login."%"
	 ));  
 }
 
 //Traz os dados do usuário com base no login e senha do mesmo
 public function login($login, $password){
 
 $sql = new Sql();
	  
	  $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
	  	":LOGIN"=>$login,
		":PASSWORD"=>$password
	  ));
	  
	  if(count($results) > 0) {	  
		  $this->setData($results[0]);	  
	 } else {
		 throw new Exception ("Login e/ou senha inválidos!"); 
	 }
 }
 
 public function setData($data) {
  $this->setIdusuario($data['idusuario']);
  $this->setDeslogin($data['deslogin']);
  $this->setDessenha($data['dessenha']);
  $this->setDtcadastro(new DateTime($data['dtcadastro']));
 }
 
 //Método INSERT para criar usuários novos a partir da classe Usuario
 public function insert() {
  $sql = new Sql();
  
  //Cria uma procedure
  $results = $sql->select("CALL sp_usuarios(:LOGIN, :PASSWORD)", array(
  ':LOGIN'=>$this->getDeslogin(),
  ':PASSWORD'=>$this->getDessenha()
  ));
  
  if(count($results)>0){
   $this->setData($results[0]);
  }
 }
 
 /* Método construtor para  receber o login e senha do usuário. Caso os parâmetros não sejam passados, a classe será alimentada com
 nulos (não será obrigatório o recebimento dos parâmetros) */
 public function __construct($login = "", $password = "") {
  $this->setDeslogin($login);
  $this->setDessenha($password);
 }
 
 //Método para mostrar as informações na tela ao solicitar ao objeto (echo)
 public function __toString() {
  return json_encode(array(
   "idusuario"=>$this->getIdusuario(),
   "deslogin"=>$this->getDeslogin(),
   "dessenha"=>$this->getDessenha(),
   "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
   ));
 }
 
 }
?>
