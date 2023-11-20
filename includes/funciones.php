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

function esUltimo($actual, $proximo){
    if($actual !== $proximo){
        //cuando el valor actual sea diferente al valor proximno significa que vamos a cambiar
        // de columna o proximo registro
        return true;
    }
    return false;
}

function isAdmin(){
    if (!isset($_SESSION['admin'])) {
       header("Location: /"); 
    }
}