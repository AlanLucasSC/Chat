<?php  
	//requirindo o arquivo funcoes.php, onde está as funções de consultas, inserts, deletes, updates
	require_once('funcoes.php');
  if (!isset($_SESSION)) {
    session_start();
  }

  	if(isset($_POST['conta']) and isset($_POST['senha'])) {
  		$login = 'conta = "'.$_POST['conta'].'"';
  		$senha = 'senha = "'.$_POST['senha'].'"';
  		$a = $consulta->SELECT("*")->FROM('usuario')->WHERE($login)->WHERE($senha)->FINALIZE();	// responde com
      if (!empty($a)) {
        $b = json_decode($a);
        $_SESSION['id'] = $b;
        $_SESSION['conta'] = $_POST['conta'];
        $_SESSION['senha'] = $_POST['senha'];
        echo $a;
      }
  	}

    if(isset($_POST['text'])) {
      $insercao->INSERT('mensage', 'text', 'user_id')->VALUE($_POST['text'], $_SESSION['id'][0]->id);
      echo 'ok';
    }

    if (isset($_POST['mensage'])) {
      $where = 'mensage.id > '.$_SESSION['length_id'];
      $a = $consulta->SELECT('mensage.id as id_mensage', 'conta', 'text', 'usuario.id as id')->FROM('mensage')->COMBINE('INNER', 'usuario', 'mensage.user_id', 'usuario.id')->WHERE($where)->ORDER_BY('id_mensage', 'ASC')->FINALIZE();
      if (strlen($a) > 2) {
        $b = json_decode($a);
        if (count($b) != 0) {
          $_SESSION['length_id'] = array_pop($b)->id_mensage;
          echo $a;
        }
      }
    }

?>