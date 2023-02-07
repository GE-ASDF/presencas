<?php 

include_once "../models/find.php";
$CodigoContrato = strip_tags($_GET["CodigoContrato"]);

if($CodigoContrato){
    $findAluno = fetch("prepara", ["CodigoContrato" => $CodigoContrato], "loginagendamentoaluno AS L", 
    "L.NomeAluno, L.CodigoContrato", " WHERE L.CodigoContrato = :CodigoContrato", "", " GROUP BY L.CodigoContrato");

    if($findAluno){
	    $iguais = strcasecmp(strval($findAluno->CodigoContrato), strval($CodigoContrato));
        if($iguais == 0){
            echo json_encode($findAluno);
            return;
        }else{
            $findAluno = fetch("prepara", ["CodigoContrato" => $CodigoContrato], "pr_perfilalunos AS P", 
            "P.Nome AS NomeAluno, P.CodigoContrato", " WHERE P.CodigoContrato = :CodigoContrato", "", " GROUP BY P.CodigoContrato");
        if($findAluno){
            $iguais = strcasecmp(strval($findAluno->CodigoContrato), strval($CodigoContrato));
            if($iguais == 0){
                echo json_encode($findAluno);
                return; 
            }else{
                echo json_encode(['message'=>'Não foi possível validar os dados. Tente novamente!']);
                return;
            }
        }else{
            echo json_encode(['message'=>'Não foi possível validar os dados. Tente novamente!']);
            return;
        }
        echo json_encode(['message'=>'Não foi possível validar os dados. Tente novamente!']);
    	return;
}
    }else{
        echo json_encode(['message'=>'Não foi possível validar os dados. Tente novamente!']);
    	return;
    }

}else{
    echo json_encode(['message'=>'Não foi possível validar os dados. Tente novamente!']);
return;
} 
?>