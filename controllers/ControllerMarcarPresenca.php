<?php

include_once "../verificacoes/Verificacoes.php";

// include_once "../models/find.php";
include_once "../models/insert.php";
// include_once "../helpers/dd.php";
include_once "../helpers/sessions.php";
include_once "../helpers/redirect.php";
include_once "../classes/Validacoes.php";

if($_POST){

    $validacao = new Validacoes;

    $data = [
        "CodigoContrato" => "int|string",
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
        
       //
        $findAluno = (new Verificacoes)->verificaPrepara($toFindUser);
      
        if($findAluno){
            foreach($validar["HoraPresenca"] as $key => $HoraPresenca){

                $dadosValidados = [
                    "CodigoContrato" => $validar["CodigoContrato"],
                    "HoraPresenca"=> $HoraPresenca[$key],
                    "DataPresenca"=> $validar["DataPresenca"]
                ];
         
                $find = (new Verificacoes)->verificaPresencas($dadosValidados);
                if($find === false){
                    $dados = [
                        "CodigoContrato" => $validar["CodigoContrato"],
                        "NomeAluno" => $findAluno->NomeAluno,
                        "HoraPresenca" => $dadosValidados['HoraPresenca'],
                        "DataPresenca" => $validar["DataPresenca"],
                        "Computador" => $validar["Computador"],
                        "IpComputador" => $validar["IpComputador"],
                        "DiaSemana" => $validar["DiaSemana"],
                    ];

                    $insert = insert("presencas", "presencas", $dados);

                    if($insert){
                        setMessage("Sucesso! A sua presença foi confirmada e você já pode começar a sua aula. Minimize o navegador e bom curso.", "message", "success");
                        echo 1;
                    }else{
                        setMessage("Falha! Houve erros na hora de marcar a sua presença. Peça ao(a) educador(a) que a faça manualmente. Obrigado e boa aula!", "message");
                        echo 2;
                    }
                }else{
                    setMessage("A sua presença já foi confirmada.", "message", "primary");
                    echo 3;
                }
            }
        
        }else{
            $findAluno =  (new Verificacoes)->verificaOuro($toFindUser);
            if($findAluno){
                foreach($validar["HoraPresenca"] as $key => $HoraPresenca){

                    $dadosValidados = [
                        "CodigoContrato" => $validar["CodigoContrato"],
                        "HoraPresenca"=> $HoraPresenca[$key],
                        "DataPresenca"=> $validar["DataPresenca"]
                    ];
             
                    $find = (new Verificacoes)->verificaPresencas($dadosValidados);
                    if($find === false){
                        $dados = [
                            "CodigoContrato" => $validar["CodigoContrato"],
                            "NomeAluno" => $findAluno->NomeAluno,
                            "HoraPresenca" => $dadosValidados['HoraPresenca'],
                            "DataPresenca" => $validar["DataPresenca"],
                            "Computador" => $validar["Computador"],
                            "IpComputador" => $validar["IpComputador"],
                            "DiaSemana" => $validar["DiaSemana"],
                        ];
    
                        $insert = insert("presencas", "presencas", $dados);
    
                        if($insert){
                            setMessage("Sucesso! A sua presença foi confirmada e você já pode começar a sua aula. Minimize o navegador e bom curso.", "message", "success");
                            echo 1;
                    
                        }else{
                            setMessage("Falha! Houve erros na hora de marcar a sua presença. Peça ao(a) educador(a) que a faça manualmente. Obrigado e boa aula!", "message");
                            echo 2;
                        }
                    }else{
                        setMessage("A sua presença já foi confirmada e você já pode começar a sua aula. Minimize o navegador e bom curso.", "message", "primary");
                        echo 3;
                
                    }
                }
            }else{
                setMessage("A presença não foi confirmada, pois o usuário digitado não foi encontrado. Tente novamente!", "message");
                echo 2;
        
            }
        }
    }else{

        echo 2;
    }
    
    
}else{
    setMessage("O método de envio deve ser POST", "verboerrado");
    echo 2;
}