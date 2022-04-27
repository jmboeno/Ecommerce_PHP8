<div class="container">
    <div class="row my-5">
        <div class="col-sm-6 offset-sm-3">
            <h3 class="text-center">Registro de Novo Cliente</h3>

            <form action="?a=criar_cliente" method="post">

                <!--nome-->
                <div class="my-2">
                    <label>Nome completo</label>
                    <input type="text" name="text_nome_completo" placeholder="Nome" class="form-control" require>
                </div>

                <!--nome-->
                <div class="my-2">
                    <label>Endereço</label>
                    <input type="text" name="text_endereco" placeholder="Ex: Rua A, 123, Bairro B" class="form-control" require>
                </div>

                <!--cidade-->
                <div class="my-2">
                    <label>Cidade</label>
                    <input type="text" name="text_cidade" placeholder="Cidade" class="form-control" require>
                </div>

                <!--telefone-->
                <div class="my-2">
                    <label>Telefone</label>
                    <input type="text" name="text_telefone" placeholder="Telefone" class="form-control" require>
                </div>

                <!--email-->
                <div class="my-2">
                    <label>Email</label>
                    <input type="email" name="text_email" placeholder="Email" class="form-control" require>
                </div>

                <!--senha-1-->
                <div class="my-2">
                    <label>Senha</label>
                    <input type="password" name="text_senha_1" placeholder="Senha" class="form-control" require>
                </div>

                <!--senha-2-->
                <div class="my-2">
                    <label>Repetir a senha</label>
                    <input type="password" name="text_senha_2" placeholder="Repetir a senha" class="form-control" require>
                </div>

                
                <?php if(isset($_SESSION['erro'])): ?>
                    <div class="alert alert-danger text-center p-2">
                        <?= $_SESSION['erro'] ?>
                        <?php unset($_SESSION['erro']) ?>
                    </div>
                <?php endif;?>

                <!-- submit -->
                <div class="my-4">
                    <input type="submit" value="Criar conta" class="btn btn-primary" require>
                </div>


            </form>

            

        </div>
    </div>
</div>