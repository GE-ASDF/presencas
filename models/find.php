<?php

include_once "../global_includes/databases.php";
include_once "../connection/connection.php";

function fetch(string $banco, array $data, string $table, string $fields = '*', string $critery = '', string $order = '', string $group = ''){
    if(is_array($data)){

        $db = function_exists($banco) ? $banco:'';
        if($db != ''){
            $conectar = conectar(call_user_func($db));
            $sql = "SELECT {$fields} FROM {$table} {$critery} {$order} {$group}";
            $prepare = $conectar->prepare($sql);
            $prepare->execute($data);
            return $prepare->fetch();
        }else{
            return "Nenhum banco de dados foi passado como parâmetro.";
        }

    }else{
        return "Os dados precisam ser enviados como um array associativo";
    }
}

function fetchAll(string $table = '', string $fields = '*', string $critery = '', string $order = '', string $group = ''){

        $db = presencas();
        $conectar = conectar($db);
        $sql = "SELECT {$fields} FROM {$table} {$critery} {$order} {$group}";
        $prepare = $conectar->prepare($sql);
        $prepare->execute();
        return $prepare->fetchAll();

}

function fetchAllWithCritery($banco, array $data, string $table = '', string $fields = '*', string $critery = '', string $order = '', string $group = ''){

    $db = function_exists($banco) ? $banco:'';
    
    if($db != ''){
        $conectar = conectar(call_user_func($db));
        $sql = "SELECT {$fields} FROM {$table} {$critery} {$order} {$group}";
        $prepare = $conectar->prepare($sql);
        $prepare->execute($data);
        return $prepare->fetchAll();
    }

}