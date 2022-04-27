<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Clientes;

class Main{

    // ================================================================
    public function index()
    {   

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'inicio',
            'layouts/html_footer',
            'layouts/footer',
        ]);

    }

    // ================================================================
    public function loja()
    {
        // Apresenta a página loja
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'loja',
            'layouts/html_footer',
            'layouts/footer',
        ]);
    }

        // ================================================================
        public function novo_cliente()
        {
            // Verifica se já existe sessão aberta
            if(Store::clienteLogado()){
                $this->index();
                return;
            }    
            
            // Apresenta o layout para criar um novo utilizador
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'criar_cliente',
                'layouts/html_footer',
                'layouts/footer',
            ]);
        }

        public function criar_cliente()
        {
            // Verifica se já existe sessão aberta
            if(Store::clienteLogado()){
                $this->index();
                return;
            }
            
            // Verifica se já existe sessão aberta
            if($_SERVER['REQUEST_METHOD'] != 'POST'){
                $this->index();
                return;
            }      
            
            // Verifica se senha 1 é igual a senha 2
            if ($_POST['text_senha_1'] !== $_POST['text_senha_2']){

                // As senhas são doferentes
                $_SESSION['erro'] = 'As senhas não são iguais';
                $this->novo_cliente();
                return;

            }

            // Verifica na Base de Dados se existe cliente com o mesmo e-mail
            $cliente = new Clientes();

            if($cliente->verificar_email_existe($_POST['text_email'])){

                $_SESSION['erro'] = 'Já existe um cliente com esse e-mail';
                $this->novo_cliente();
                return;
            
            }

            // Inserir  novo cliente na base de dados e devolver o purl
            $purl = $cliente->registrar_cliente();

            // Envio do email para o cliente
            $email = new EnviarEmail();
            $email_cliente = strtolower(trim($_POST['text_email']));
            $resultado = $email->enviar_confirmacao_novo_cliente($email_cliente, $purl);

            if($resultado){
                echo 'Email enviado!';
            }else{
                echo 'Aconteceu um erro!';
            }
            
        }

        public function confirmar_email(){

            // Verifica se já existe sessao
            if(Store::clienteLogado()){
                $this->index();
                return;
            }

            // Verifica se existe na query string um purl
            if(!isset($_GET['purl'])){
                $this->index();
                return;
            }

            $purl = $_GET['purl'];
            
            // Verifica se o purl é válido
            if(strlen($purl) != 12){
                $this->index();
                return;
            }

            $cliente = new Clientes();
            $resultado = $cliente->validar_email($purl);

            if($resultado){
                echo 'Conta validada com sucesso.';
            } else {
                echo 'A conta não foi validada.';
            }

            /*
            1. conectar à bd
            2. pesquisar a existência de um cliente com purl indicado
                nao existe> erro
                existe?
                    a. remove o purl do clinete
                    b. alterar o ativo = 1
                    c. apresentar mensagem de registro concluído com sucesso
            */

        }
    
        // ================================================================
        public function carrinho()
        {
            // Apresenta a página loja
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'carrinho',
                'layouts/html_footer',
                'layouts/footer',
            ]);
        }

}