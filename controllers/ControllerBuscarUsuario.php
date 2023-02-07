<?php

include_once "../models/find.php";

$toFindUser = [
    "NomeAluno" => strip_tags($_POST["NomeAluno"]),
];

if ($toFindUser["NomeAluno"] != '') {

    $findAluno = fetch("prepara", $toFindUser, "loginagendamentoaluno", "DISTINCT CodigoContrato, SenhaAluno", " WHERE NomeAluno = :NomeAluno", "", " GROUP BY CodigoContrato");

    if ($findAluno == false) {
        $findAluno = fetch("prepara", $toFindUser, "pr_perfilalunos", "DISTINCT CodigoContrato", " WHERE Nome = :NomeAluno", "", " GROUP BY CodigoContrato");
        if ($findAluno == false) {
            $findAluno = fetch("ouro", $toFindUser, "usuarios AS L", "L.LOGIN AS CodigoContrato, L.SENHA AS SenhaAluno ", " WHERE L.NOME = :NomeAluno");
            if ($findAluno == false) {
                echo json_encode([
                    "message" => "Aluno não encontrado",
                    "typeMessage" => "danger"
                ]);
                return;
            } else {
                echo json_encode(["CodigoContrato" => $findAluno->CodigoContrato, "SenhaAluno" => $findAluno->SenhaAluno, "typeMessage" => "success", "message" => "O seu usuário é: {$findAluno->CodigoContrato} </br> A sua senha é: {$findAluno->SenhaAluno}"]);
                return;
            }
        } else {
            echo json_encode(["CodigoContrato" => $findAluno->CodigoContrato, "typeMessage" => "success", "message" => "O seu usuário é: {$findAluno->CodigoContrato} </br> A sua senha é: Prep-123"]);
            return;
        }
    } else {
        echo json_encode(["CodigoContrato" => $findAluno->CodigoContrato, "SenhaAluno" => $findAluno->SenhaAluno, "typeMessage" => "success", "message" => "O seu usuário é: {$findAluno->CodigoContrato} </br> A sua senha é: {$findAluno->SenhaAluno}"]);        return;
    }

}else{
    echo json_encode([
        "message" => "É necessário digitar seu nome completo.",
        "typeMessage" => "danger"
    ]);
    return;
}