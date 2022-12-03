<?php

include_once "../models/find.php";
include_once "../models/insert.php";
include_once "../helpers/dd.php";
include_once "../helpers/sessions.php";
include_once "../helpers/redirect.php";
include_once "../classes/Validacoes.php";

if($_POST){

    $validacao = new Validacoes;

    $data = [
        "CodigoContrato" => "string",
        "HoraPresenca" => "string" ,
        "DiaSemana" => "string",
        "DataPresenca" => "string",
        "Computador" => "string",
        "IpComputador" => "string"
    ];

    $validar = $validacao->Validate($data);
    
    if($validar){
        $toFindUser = [
            "CodigoContrato" => $validar["CodigoContrato"]
        ];
        $find = fetch("prepara", $toFindUser, "loginagendamentoaluno AS L, pr_perfilalunos AS P", "*", "WHERE L.CodigoContrato = :CodigoContrato OR P.CodigoContrato = :CodigoContrato");
        if($find){
            var_dump($find);
        }
    }else{
        redirect("/presenca");
    }
    
    
}else{
    return setMessage("O método de envio deve ser POST", "verboerrado");
}