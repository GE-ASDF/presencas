<?php

session_start();

function setMessage($message, $index, $type = 'danger'){
    
    if(isset($_SESSION[$index])){
        unset($_SESSION[$index]);
    }

    if(!isset($_SESSION[$index])){
        $_SESSION[$index] = "
        <span class='alert w-100 alert-{$type} d-flex justify-content-between align-items-center'> 
            <span class='justify-self-center align-self-center'>{$message}</span>
            <span class='btn btn-danger justify-content-end align-items-end close-message'>
            X
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
