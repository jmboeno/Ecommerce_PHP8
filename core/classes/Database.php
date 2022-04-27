<?php

namespace core\classes;

use Exception;
use PDO;
use PDOException;

class Database{

    private $ligacao;

    //============================================================
    private function ligar(){
        //ligar à base de dados
        $this->ligacao = new PDO(
            'mysql:'.
            'host='.MYSQL_SERVER.';'.
            'dbname='.MYSQL_DATABASE.';'.
            'charset='.MYSQL_CHARSET,
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT => true)
        );

        //debug
        $this->ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    }

    //============================================================
    private function desligar(){
        $this->ligacao =null;
    }

    // ============================================================
    // CRUD
    // ============================================================
    public function select($sql, $parametros = null){

        $sql = trim($sql);

        // verifica se é uma instrução SELECT
        if(!preg_match("/^SELECT/i", $sql)){
            throw new Exception('Base de dados - Não é uma instrução SELECT');
        }

        //liga
        $this->ligar();

        $resultados = null;

        //comunicar
        try{
            
            //comunicacao com a bd
            if(!empty($parametros)){
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            }

        } catch (PDOException $e) {

            //caso de erro
            return false;

        }

        //desligar da bd
        $this->desligar();

        //devolver resultados obtidos
        return $resultados;

    }

    // ============================================================
    public function insert($sql, $parametros = null){

        $sql = trim($sql);

        // verifica se é uma instrução INSERT
        if(!preg_match("/^INSERT/i", $sql)){
            throw new Exception('Base de dados - Não é uma instrução INSERT');
        }

        //ligar
        $this->ligar();

        $resultados = null;

        //comunicar
        try{
            
            //comunicacao com a bd
            if(!empty($parametros)){
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }

        } catch (PDOException $e) {

            //caso de erro
            return false;

        }

    }

    // ============================================================
    public function update($sql, $parametros = null){

        $sql = trim($sql);

        // verifica se é uma instrução UPDATE
        if(!preg_match("/^UPDATE/i", $sql)){
            throw new Exception('Base de dados - Não é uma instrução UPDATE');
        }

        //ligar
        $this->ligar();

        $resultados = null;

        //comunicar
        try{
            
            //comunicacao com a bd
            if(!empty($parametros)){
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }

        } catch (PDOException $e) {

            //caso de erro
            return false;

        }

    }

    // ============================================================
    public function delete($sql, $parametros = null){

        $sql = trim($sql);

        // verifica se é uma instrução DELETE
        if(!preg_match("/^DELETE/i", $sql)){
            throw new Exception('Base de dados - Não é uma instrução DELETE');
        }

        //ligar
        $this->ligar();

        $resultados = null;

        //comunicar
        try{
            
            //comunicacao com a bd
            if(!empty($parametros)){
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }

        } catch (PDOException $e) {

            //caso de erro
            return false;

        }

    }

    // ============================================================
    // GENERIC
    // ============================================================
    public function statement($sql, $parametros = null){

        $sql = trim($sql);

        // verifica se é uma instrução diferente das anteriores
        if(preg_match("/^(SELECT|INSERT|UPDATE|DELETE)/i", $sql)){
            throw new Exception('Base de dados - Instrução inválida');
        }

        //ligar
        $this->ligar();

        $resultados = null;

        //comunicar
        try{
            
            //comunicacao com a bd
            if(!empty($parametros)){
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }

        } catch (PDOException $e) {

            //caso de erro
            return false;

        }

    }


}

/*
    CRUD
    Create  - INSERT
    Ready   - SELECT
    Update  - UPDATE
    Delete  - DELETE
*/