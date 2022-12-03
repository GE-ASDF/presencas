<?php

function conectar(Array $accessBd){
    $pdo = NULL;
    
    if(is_array($accessBd)){

        $servidor = $accessBd["servidor"];
        $banco = $accessBd["banco"];
        $porta = $accessBd["porta"] ? $accessBd["senha"]:'3306';
        $usuario = $accessBd["usuario"];
        $senha = $accessBd["senha"];
        
        if($pdo === NULL){
            try{
                $pdo = new PDO("mysql:host=$servidor;dbname=$banco;port=$porta", $usuario, $senha, [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]);

                if($pdo){
                    return $pdo;
                }else{
                    return NULL;
                }
                
            }catch(PDOException $e){
                var_dump($e->getMessage());
            }
        
        }else{
            return $pdo;
        }

    }else{
        return "Para criar uma conexão os dados de acesso ao banco devem ser enviados como um array associativo.";
    }
}