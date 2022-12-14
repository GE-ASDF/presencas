<?php

session_start();

function setMessage($message, $index, $type = 'danger'){
    
    if(isset($_SESSION[$index])){
        unset($_SESSION[$index]);
    }

    if(!isset($_SESSION[$index])){
        $_SESSION[$index] = "
        <span class='alert w-100 justify-content-between d-flex alert-{$type}'>
            <span id='text-message'>{$message}</span>
                <span style='cursor: pointer;' class='btn-close d-block'>
                </span>
        </span>
        ";

    }
    
}

function getMessage($index){

    if(isset($_SESSION[$index])){
        $message = $_SESSION[$index];
        unset($_SESSION[$index]);
        return $message;
    }

}
