<?php

include_once "../helpers/sessions.php";

class Validacoes{

    public function Validate(array $data){
        $validado = [];
        if(is_array($data)){

            foreach($data as $key => $value){
                if(strpos($value, "|")){
                    $explodedBar = explode("|", $value);
                    return $explodedBar;
                }else{
                    if(method_exists(new Validacoes, $value)){
                        $validado[$key] = (new Validacoes)->$value($key);
                    }
                }
            }

        }else{
            return "Os dados devem estar no formato de array";
        }
        if(!in_array(false, $validado)){
            return $validado;
        }else{
            return false;
        }
    }

    private function string(string $key){
        
        if($_POST){
            // $dado = filter_var(self::getPostData($key), FILTER_SANITIZE_STRING);
            $dados = self::getPostData($key);
            if(is_array($dados)){
                $newDados = array();
                foreach($dados as $chave => $data){
                    $dado = strip_tags($data);
                    $newDados[] = [
                        $chave => $dado,
                    ];
                }
                return $newDados;
            }else{
                return $dados;
            }

        }elseif($_GET){

        }else{
            return setMessage("Nenhum verbo HTTP foi passado", "verboerrado");
        }

    }

    private function getPostData(string $key){
        $newData = isset($_POST[$key]) ? $_POST[$key]:false;
        if(!$newData){
            setMessage("O campo é obrigatório.", $key);
            return;
        }
        return $newData;
    }

    private function getGetData(string $key){
        $newData = isset($_GET[$key]) ? $_GET[$key]:false;
        if(!$newData){
            setMessage("O campo é obrigatório.", $key);
            return;
        }
        return $newData;
    }
}