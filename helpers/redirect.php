<?php

function redirect($page){
    header("Location:{$page}");
}

function refresh($time, $url){
    header("Refresh: {$time}; url={$url}");
}