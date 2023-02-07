<?php

include_once "../verificacoes/Verificacoes.php";

// include_once "../models/find.php";
include_once "../models/insert.php";
// include_once "../helpers/dd.php";
include_once "../helpers/sessions.php";
include_once "../helpers/redirect.php";
include_once "../classes/Validacoes.php";

$girou = 0;
if($_POST){

    $from = isset($_POST["from"]) ? strtolower(strip_tags($_POST["from"])) : "";

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
            "CodigoContrato" => trim($validar["CodigoContrato"])
        ];
        
        
        $findAluno = (new Verificacoes)->verificaPrepara($toFindUser);


        if($findAluno){

            $string1 = (string) $findAluno->CodigoContrato; 
            $string2 = (string) $toFindUser["CodigoContrato"];

            if(strcasecmp($string1, $string2) < 0){
                echo json_encode([
                    "CodigoResposta" => 2,
                    "typeMessage" => "danger",
                    "message" => "
                    A presença não foi confirmada, pois o usuário digitado não foi encontrado. 
                    Tente novamente! </br>
                    Caso tenha esquecido seu usuário, clique em ESQUECI MEU USUÁRIO, digite seu nome completo e clique em BUSCAR.
                    "
                ]);
                // setMessage("A presença não foi confirmada, pois o usuário digitado não foi encontrado. Tente novamente! </br>
                //     Caso tenha esquecido seu usuário, clique em ESQUECI MEU USUÁRIO, digite seu nome completo e clique em BUSCAR
                //     ", "message");
                // // redirect("/presencas");
                return;
            };

            
            foreach($validar["HoraPresenca"] as $key => $HoraPresenca){
                $girou = $girou + 1;
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
                            // setMessage("Sucesso! A sua presença foi confirmada e você já pode começar a sua aula. Minimize o navegador e bom curso.", "message", "success");
                            // if($from == "admin"){
                            //     redirect("http://192.168.1.11/presencas/index.php?from=admin");
                            // }
                        
                        if($girou >= count($validar["HoraPresenca"])){
                            echo json_encode([
                                "CodigoResposta" => 1,
                                "typeMessage" => "success",
                                "message" => "Sucesso! A sua presença foi confirmada e você já pode começar a sua aula. Minimize o navegador e bom curso."
                            ]);
                            return;
                        }else{
                            continue;
                        }
                        // redirect("/presencas");
                    }else{
                            // setMessage("Falha! Houve erros na hora de marcar a sua presença. Peça ao(a) educador(a) que a faça manualmente. Obrigado e boa aula!", "message");
                            // if($from == "admin"){
                            //     redirect("http://192.168.1.11/presencas/index.php?from=admin");
                            // }
                           
                            if($girou >= count($validar["HoraPresenca"])){
                                echo json_encode([
                                    "CodigoResposta" => 2,
                                    "typeMessage" => "danger",
                                    "message" => "Falha! Houve erros na hora de marcar a sua presença. Peça ao(a) educador(a) que a faça manualmente. Obrigado e boa aula!"
                                ]);
                                return;
                            }else{
                                continue;
                            }
                        //    redirect("/presencas");
                    }
                }else{
                    if($girou >= count($validar["HoraPresenca"])){
                        echo json_encode([
                            "CodigoResposta" => 2,
                            "typeMessage" => "primary",
                            "message" => "A sua presença já foi confirmada e você já pode começar a sua aula. Minimize o navegador e bom curso."
                        ]);
                        return;
                    }else{
                        continue;
                    }
                }
                
            }
        
        }else{
            $findAluno =  (new Verificacoes)->verificaOuro($toFindUser);
            if($findAluno){
                
                $string1 = (string) $findAluno->CodigoContrato; 
                $string2 = (string) $toFindUser["CodigoContrato"];

                if(strcasecmp($string1, $string2) < 0){
                    echo json_encode([
                        "CodigoResposta" => 2,
                        "typeMessage" => "danger",
                        "message" => "A presença não foi confirmada, pois o usuário digitado não foi encontrado. 
                        Tente novamente!
                        </br>
                    Caso tenha esquecido seu usuário, clique em ESQUECI MEU USUÁRIO, digite seu nome completo e clique em BUSCAR."
                    ]);
                    // setMessage("A presença não foi confirmada, pois o usuário digitado não foi encontrado. Tente novamente! </br>
                    // Caso tenha esquecido seu usuário, clique em ESQUECI MEU USUÁRIO, digite seu nome completo e clique em BUSCAR
                    // ", "message");
                    // // redirect("/presencas");
                    return;
                };

                foreach($validar["HoraPresenca"] as $key => $HoraPresenca){
                    $girou = $girou + 1;
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
                                //  setMessage("Sucesso! A sua presença foi confirmada e você já pode começar a sua aula. Minimize o navegador e bom curso.", "message", "success");
                                //  if($from == "admin"){
                                //      redirect("http://192.168.1.11/presencas/index.php?from=admin");
                                //  }
                            if($girou >= count($validar["HoraPresenca"])){
                                echo json_encode([
                                    "CodigoResposta" => 1,
                                    "typeMessage" => "success",
                                    "message" => "Sucesso! A sua presença foi confirmada e você já pode começar a sua aula. Minimize o navegador e bom curso."
                                ]);
                                return;
                            }else{
                                continue;
                            }
                                // redirect("/presencas");
                        }else{
                                //  setMessage("Falha! Houve erros na hora de marcar a sua presença. Peça ao(a) educador(a) que a faça manualmente. Obrigado e boa aula!", "message");
                                //  if($from == "admin"){
                                //      redirect("http://192.168.1.11/presencas/index.php?from=admin");
                                //  }
                                if($girou >= count($validar["HoraPresenca"])){
                                    echo json_encode([
                                        "CodigoResposta" => 2,
                                        "typeMessage" => "danger",
                                        "message" => "Falha! Houve erros na hora de marcar a sua presença. Peça ao(a) educador(a) que a faça manualmente. Obrigado e boa aula!"
                                    ]);
                                    return;
                                }else{
                                    continue;
                                }
                            // redirect("/presencas");
                        }
                    }else{
                            // setMessage("A sua presença já foi confirmada e você já pode começar a sua aula. Minimize o navegador e bom curso.", "message", "primary");
                            // if($from == "admin"){
                            //     redirect("http://192.168.1.11/presencas/index.php?from=admin");
                            // }
                            if($girou >= count($validar["HoraPresenca"])){
                                echo json_encode([
                                    "CodigoResposta" => 2,
                                    "typeMessage" => "primary",
                                    "message" => "A sua presença já foi confirmada e você já pode começar a sua aula. Minimize o navegador e bom curso."
                                ]);
                                return;
                            }else{
                                continue;
                            }   
                    }
                }
            }else{
                    
                    if($from == "admin"){
                        redirect("http://192.168.1.11/presencas/index.php?from=admin");
                    }
                    echo json_encode([
                        "CodigoResposta" => 2,
                        "typeMessage" => "danger",
                        "message" => "A presença não foi confirmada, pois o usuário digitado não foi encontrado. Tente novamente!
                        </br>
                    Caso tenha esquecido seu usuário, clique em ESQUECI MEU USUÁRIO, digite seu nome completo e clique em BUSCAR."
                    ]);
                    // setMessage("A presença não foi confirmada, pois o usuário digitado não foi encontrado. Tente novamente! </br>
                    // Caso tenha esquecido seu usuário, clique em ESQUECI MEU USUÁRIO, digite seu nome completo e clique em BUSCAR
                    // ", "message");
                    // redirect("/presencas");
            }
        }
        }else{
            echo json_encode([
                "CodigoResposta" => 2,
                "typeMessage" => "danger",
                "message" => "Ocorreu um erro na hora de marcar sua presença. </br><strong>Verifique os seguintes parâmetros:</strong>
                    <ul class='bg-primary text-white p-2'>
                        <li>Se você digitou seu usuário corretamente;</li>
                        <li>Se você marcou os horários da sua aula nas caixinhas.</li>
                    </ul>
                "
            ]);
            setMessage("Ocorreu um erro na hora de marcar sua presença. </br><strong>Verifique os seguintes parâmetros:</strong>
            <ul class='bg-primary text-white p-2'>
                <li>Se você digitou seu usuário corretamente;</li>
                <li>Se você marcou os horários da sua aula nas caixinhas.</li>
            </ul>", "message");
            // redirect("/presencas");
        }
    
}else{
        setMessage("O método de envio deve ser POST", "verboerrado");
        if($from == "admin"){
            redirect("http://192.168.1.11/presencas/index.php?from=admin");
        }
        echo json_encode([
            "CodigoResposta" => 2,
            "typeMessage" => "danger",
            "message" => "O método de envio deve ser POST."
        ]);
    // redirect("/presencas");
}