<?php

include_once "../models/find.php";
include_once "../models/insert.php";
include_once "../helpers/dd.php";
include_once "../classes/Validacoes.php";

class Verificacoes{

    public function verificaPrepara(array $data){
        return fetch("prepara", $data, "loginagendamentoaluno AS L, pr_perfilalunos AS P", "P.Nome AS NomeAluno, L.NomeAluno AS NomeAluno", "WHERE L.CodigoContrato = :CodigoContrato OR P.CodigoContrato = :CodigoContrato");
    }

    public function verificaOuro(array $data){
        return fetch("ouro", $data, "usuarios AS L", "L.NOME AS NomeAluno", "WHERE L.LOGIN = :CodigoContrato");;
    }

    public function verificaPresencas(array $data){
        return fetch("presencas", $data, "presencas AS L", "*", "WHERE L.CodigoContrato = :CodigoContrato AND L.HoraPresenca = :HoraPresenca AND L.DataPresenca = :DataPresenca");
    }

}