<?php

include_once "../global_includes/constants.php";
include_once "../verificacoes/Verificacoes.php";
include_once "../models/find.php";
include_once "../models/insert.php";
include_once "../helpers/dd.php";
include_once "../helpers/sessions.php";
include_once "../helpers/redirect.php";
include_once "../classes/Validacoes.php";

$tentativas = isset($_POST["tentativas"]) ? filter_var($_POST["tentativas"], FILTER_SANITIZE_NUMBER_INT):"";

if ($tentativas && $tentativas < 3) {
    if ($_POST) {

        $toValidate = [
            "CodigoColaborador" => "string",
            "SenhaColaborador" => "string",
        ];

        $Validate = (new Validacoes)->Validate($toValidate);

        if ($Validate) {
            $CharLoginColaborador = strtoupper($Validate["CodigoColaborador"][0]);
            $CodigoColaborador = substr($Validate["CodigoColaborador"], 1);

            $data = [
                "CodigoColaborador" => $CodigoColaborador,
                "CharLoginColaborador" => $CharLoginColaborador,
                "SenhaColaborador" => $Validate["SenhaColaborador"],
            ];

            $find = fetch("prepara", $data, "vwcolaboradorfranquia", "*", " 
            WHERE CodigoColaborador = :CodigoColaborador AND CharLoginColaborador = :CharLoginColaborador AND 
            SenhaColaborador = :SenhaColaborador
    ");

            if ($find) {
                $_SESSION["logado"] = $find;
                unset($_SESSION["logado"]->SenhaColaborador);
                redirect(URL_BASE . "admin/");
            } else {

                if (!isset($_SESSION["tentativas"])) {
                    $_SESSION["tentativas"] = 1;
                } else {

                    $_SESSION["start"] = [
                        "situation" => "active",
                        "registered" => time()
                    ];

                    $_SESSION["tentativas"] = $_SESSION["tentativas"] + 1;
                }

                setMessage("O usuário não foi encontrado. Tente novamente!", "notfound");
                redirect(URL_BASE . "/admin/login.php");
            }

        } else {
            redirect(URL_BASE . "/admin/login.php");
        }

    } else {
        redirect(URL_BASE . "admin/login.php");
    }
}else{

    $reg = $_SESSION['start']['registered'];
    if(time() - $reg > 3 * 10){
        unset($_SESSION["start"]);
        unset($_SESSION["tentativas"]);
    }
    setMessage("Muitas tentativas de login! Espere 3 minutos e tente novamente.", "somuch");
    redirect(URL_BASE . "admin/login.php");
}