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
            echo "<pre>";
        
            foreach($validar["HoraPresenca"] as $key => $HoraPresenca){

                $dadosValidados = [
                    "CodigoContrato" => $validar["CodigoContrato"],
                    "HoraPresenca"=> $HoraPresenca[$key],
                    "DataPresenca"=> $validar["DataPresenca"]
                ];
                $find = fetch("presencas", $dadosValidados, "presencas AS L", "*", "WHERE L.CodigoContrato = :CodigoContrato AND HoraPresenca = :HoraPresenca AND DataPresenca = :DataPresenca");
                if(!$find){

                }else{
                    return setMessage("O método de envio deve ser POST", "verboerrado");
                }
            }
        
        }else{
            die("O usuário não foi encontrado");
        }
    }else{
        redirect("/presenca");
    }
    
    
}else{
    return setMessage("O método de envio deve ser POST", "verboerrado");
}