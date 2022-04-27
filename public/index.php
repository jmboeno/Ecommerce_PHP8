<?php

use core\classes\Database;

// Abrir a sessao
session_start();

// Carregar todas as classes do projeto
require_once('../vendor/autoload.php');

// Carregar sistema de rotas
require_once('../core/rotas.php');
