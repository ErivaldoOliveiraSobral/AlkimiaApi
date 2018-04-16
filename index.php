<?php
	//Headers de permissão
	header('Access-Control-Allow-Origin: *'); 
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
    
    include_once('model/Produto.php');

    //conexao
    $server = "bdalkimia.mysql.dbaas.com.br";
    $user = "bdalkimia";
    $pass = "miyuki150705";
    $database = "bdalkimia";
	$conexao = mysqli_connect($server, $user, $pass, $database);

	/*
	* 
	*/
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    	$selectQuery = "select * from wp_woocommerce_order_items where order_item_type=\"line_item\"";

		$resposta = mysqli_query($conexao, $selectQuery);
  	  	$dados = array();
    	while ($dados_array = mysqli_fetch_assoc($resposta)) {
    		$produto = new Produto();
	    	$produto->order_item_id = $dados_array['order_item_id'];
   			$produto->order_item_name = $dados_array['order_item_name'];
	    	$produto->order_item_type = $dados_array['order_item_type'];
	    	$produto->order_id = $dados_array['order_id'];
	    	array_push($dados, $produto);
    	}
    	echo json_encode($dados);
    	//echo count($dados);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    	// TODO: 
    }
?>
