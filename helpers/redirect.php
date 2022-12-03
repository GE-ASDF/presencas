<?php

function redirect($page){
    return header("Location:{$page}");
}

function refresh($time, $url){
    return header("Refresh: {$time}; url={$url}");
}