<?php

include_once "../global_includes/databases.php";
include_once "../connection/connection.php";

function insert(array $banco, string $table, array $data){
    
    if(is_array($banco) && is_array($data)){

        $conectar = conectar($banco);
        $sql = "INSERT INTO $table(";
        
        foreach($data as $dados){
            $sql.= array_keys($dados) . ", ";
        }
        $sql.= ") VALUES(";
        foreach($data as $dados){
            $sql.= ":" . array_values($dados) . ", ";
        }
        $sql.= ")";
        var_dump($sql);
        die();
        
    }else{
        return "Os dados de acesso ao banco de dados devem estar no formato de Array";
    }
}