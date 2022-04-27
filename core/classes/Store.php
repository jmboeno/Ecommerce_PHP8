<?php

namespace core\classes;

use Exception;

class Store{

    // ================================================================
    public static function Layout($estruturas, $dados = null){

        // Verifica se estruturas é um array
        if(!is_array($estruturas)){
            throw new Exception("Coleção de estrutura inválida");
        }

        // Variáveis
        if(!empty($dados) && is_array($dados)){
            extract($dados);
        }

        // Apresentar as views da aplicação
        foreach($estruturas as $estrutura){
            include("../core/views/$estrutura.php");
        }

    }

    // ================================================================
    public static function clienteLogado(){
        // verifica se existe um cliente
        return isset($_SESSION['cliente']);
    }

    // ================================================================
    public static function criarHash($num_caracteres = 12){

        // Criar hashes
        $chars = '01234567890123456789abcdefghijklmnopqrtuvwxyzabcdefghijklmnopqrtuvwxyzABCDEFGHIJKLMNOPQRTUVWXYZABCDEFGHIJKLMNOPQRTUVWXYZ';
        return substr(str_shuffle($chars), 0, $num_caracteres);

    }

}


/*

html_header.php
nav_bar.php
inicio.php
html_fotter.php

 */