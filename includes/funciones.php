<?php

function debug($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//funcion que valida autenticacion
function isAuth() : void {
    if(!isset($_SESSION["login"])){
        //si la variable de session login no existe o es false
        header("Location:/");
    }
}