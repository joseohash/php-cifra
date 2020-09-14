<?php 
// Funções

$acao = $_GET["acao"] ?? "signin";

// Logica
if($acao == 'signin') {  
  require_once("controllers/SessionController.php");
  
  session_start();

  if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
    header('location:/trabalho1/index.php?acao=logado');
  }
  
  
  if (isset($_POST['nome']) && isset($_POST['senha'])) {

    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    $sessionController = new SessionController();

    $autenticado = $sessionController->create($nome, $senha); 

    if ($autenticado) {
      $_SESSION['logado'] = true;

      header('location:/trabalho1/index.php?acao=logado');
    } else {
      echo '<span style="color: red;">Usuário ou senha incorretos</span>';
    }
  }
  
} else if ($acao == 'logout') {

  session_start(); //to ensure you are using same session
  session_destroy(); //destroy the session
  $acao = 'signin';
  header("location:/trabalho1/index.php");

} else if ($acao == 'signup') {
  
  if (isset($_POST['nome']) && isset($_POST['senha'])) {

    require_once("controllers/UserController.php");
    
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    
    $userController = new UserController();
    
    $userController->create($nome, $senha);
    
    $acao = 'signin';
    header("location:/trabalho1/index.php");
    
  }

} else if ($acao == 'cadastrar-cifra') {    
  if (isset($_POST['autor'])) {

    require_once("controllers/CifraController.php");
  
    $autor = $_POST['autor'];
    $musica = $_POST['musica'];
    $conteudo = $_POST['conteudo'];
    
    $cifraController = new CifraController();

    $cifraController->create($musica, $autor, $conteudo);
  }

}
// UI
require_once("views.php");