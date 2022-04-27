<?php 
    use core\classes\Store;
    //$_SESSION['cliente'] = 1;
?>
<div class="container-fluid navegacao">
    <div class="row">
        <div class="col-6 p-3">
            <h3>
                <a href="?a=inicio">
                    <?= APP_NAME ?>
                </a>
            </h3>
        </div>
        <div class="col-6 text-end p-3">

            <a href="?a=inicio" class="nav-item">Inicio</a>
            <a href="?a=loja" class="nav-item">Loja</a>

            <!--verifica se existe cliente na sessao-->
            <?php if(Store::clienteLogado()): ?>
                <a href="?a=logout" class="nav-item">Logout</a>
                <a href="?a=minha_conta" class="nav-item">Minha Conta</a>
            <?php else: ?>
                <a href="?a=login" class="nav-item">Login</a>
                <a href="?a=novo_cliente" class="nav-item">Criar Conta</a>
            <?php endif; ?>

            <a href="?a=carrinho">
                <i class="fas fa-shopping-cart"></i>
            </a>
            <span class="badge bg-warning">10</span>
        </div>
    </div>
</div>