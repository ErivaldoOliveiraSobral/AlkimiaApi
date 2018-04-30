<?php
	//Headers de permissão
	header('Access-Control-Allow-Origin: *'); 
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
    header('Content-Type: application/json; charset=utf-8');
    
    include_once('model/Pedido.php');

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

        // Query SELECT de todos os pedidos
        $selectQuery = "SELECT 
                            pedido.id as id,
                            pedido.id_pedido as id_pedido,
                            produto.nome as nome_produto,
                            produto.peso peso_produto,
                            usuario.nome as nome_usuario,
                            endereco.end_linha_1 as endereco_usuario, 
                            endereco.end_linha_2 as bairro_usuario,
                            endereco.cidade,
                            endereco.cep,
                            endereco.pais,
                            endereco.estado,
                            usuario.telefone,
                            usuario.email,
                            produto.preco,
                            status.status as status_pedido
                        FROM ws_Pedido AS pedido
                        JOIN ws_Produto as produto on produto.id = pedido.id_produto
                        JOIN ws_Usuario as usuario on usuario.id = pedido.id_usuario
                        JOIN ws_Endereco as endereco on endereco.id_usuario = usuario.id
                        JOIN ws_Status as status on status.id = pedido.id_status;";

        $resposta = mysqli_query($conexao, $selectQuery);

  	  	$dados = array();
    	while ($dados_array = mysqli_fetch_assoc($resposta)) {
    		$pedido = new Pedido();

            $pedido->id = $dados_array['id'];
            $pedido->numeroPedido = $dados_array['id_pedido'];
            $pedido->produto = $dados_array['nome_produto'];
            $pedido->peso = $dados_array['peso_produto'];
            $pedido->nomeUsuario = $dados_array['nome_usuario'];
            $pedido->endereco = $dados_array['endereco_usuario'];
            $pedido->bairro = $dados_array['bairro_usuario'];
            $pedido->cidade = $dados_array['cidade'];
            $pedido->cep = $dados_array['cep'];
            $pedido->pais = $dados_array['pais'];
            $pedido->estado = $dados_array['estado'];
            $pedido->telefone = $dados_array['telefone'];
            $pedido->email = $dados_array['email'];
            $pedido->preco = $dados_array['preco'];
            $pedido->status = $dados_array['status_pedido'];


	    	array_push($dados, $pedido);
    	}
    	//echo json_encode($dados);
        echo json_encode($dados, JSON_UNESCAPED_UNICODE); // Para não quebrar acentuação
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    	// TODO: Falta implementar inserção
        //json_decode($json, false, 512, JSON_UNESCAPED_UNICODE)
    }
?>
