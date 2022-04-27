<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;

class Clientes{

    // ==============================================================
    public function verificar_email_existe($email){

        // Verifica se existe outra conta com o mesmo e-mail
        $bd = new Database();
        $parametros = [
            ':email' => strtolower(trim($email)),
        ];
        $resultados = $bd->select("
            SELECT email FROM clientes WHERE email = :email
        ", $parametros);

        // Se o cliente já existe
        if(count($resultados) != 0){
            return true;
        }else{
            return false;
        }

    }

    // ==============================================================
    public function registrar_cliente(){

        // Registra o novo cliente na base de dados
        $bd = new Database();

        // Cria uma hash para o registro do cliente
        $purl = Store::criarHash();
        
        // Parametros
        $parametros = [
            ':nome_completo' => (trim($_POST['text_nome_completo'])),
            ':endereco' => (trim($_POST['text_endereco'])),
            ':cidade' => (trim($_POST['text_cidade'])),
            ':telefone' => (trim($_POST['text_telefone'])),
            ':email' => strtolower(trim($_POST['text_email'])),
            ':senha' => password_hash($_POST['text_senha_1'], PASSWORD_DEFAULT),
            ':purl' => $purl,
            ':ativo' => 0
        ];

        $bd->insert("
            INSERT INTO clientes VALUES(
                0,
                :nome_completo,
                :endereco,
                :cidade,
                :telefone,
                :email,
                :senha,
                :purl,
                :ativo,
                NOW(),
                NOW(),
                NULL
            )
            ", $parametros);

            // Retorna o purl criado
            return $purl;
            
    }

    // ==============================================================
    public function validar_email($purl){

        // Validar o email do novo cliente
        $bd = new Database();
        $parametros = [
            ':purl' => $purl
        ];
        $resultados = $bd->select("
            SELECT * FROM clientes 
            WHERE purl = :purl           
        ", $parametros);

        // Verifica se foi encontrado o cliente
        if(count($resultados) != 1){
            return false;
        }

        // Foi encontrado esse clinete com o purl indicado
        $id_cliente = $resultados[0]->id_cliente;

        // Atualizar os dados do cliente
        $parametros = [
            ':id_cliente' => $id_cliente
        ];
        $bd->update("
            UPDATE clientes SET
            purl = NULL,
            ativo = 1,
            update_at = NOW()
        ", $parametros);

        return true;
    }

}