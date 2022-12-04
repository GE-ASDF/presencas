<?php

include_once "../global_includes/databases.php";
include_once "../connection/connection.php";

function insert(string $banco, string $table, array $data){
    
    if(is_array($data)){
        $db = function_exists($banco) ? $banco:'';
    
        if($db){
            $conectar = conectar(call_user_func($db));
            $sql = "INSERT INTO $table(";
            
            foreach($data as $key => $dados){
                $sql.= $key . ",";
            }
            $sql = substr($sql, 0, -1);
            $sql.= ") VALUES(";
            foreach($data as $key => $dados){
                $sql.= ":" . $key . ",";
            }
            $sql = substr($sql, 0, -1);
            $sql.= ")";
            $prepare = $conectar->prepare($sql);
            foreach($data as $key => $dados){
                $prepare->bindValue($key, $dados);
            }
            $execute = $prepare->execute($data);
            return $execute;
        }else{
            return "Este banco de dados não existe";
        }
    }else{
        return "Os dados de acesso ao banco de dados devem estar no formato de Array";
    }
}