<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">

    <div class="box box-primary" style="box-shadow: 3px 3px 6px rgba(0,0,0,0.15);">

        <?php if (isset($mensagem)): ?>
            <div id="mensagem">
                <h3 class="alert alert-success" style="margin: 10px 10px;"><?php echo $mensagem; ?></h3>
            </div>
        <?php endif ?>

        <div class="box-header with-border">
            <h3 class="box-title">Atualizar Cadastro de Fornecedor</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form"  method="POST">
            <div class="box-body">

                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $brand['name'] ?>" placeholder="Digite aqui um nome...">
                </div>

                <div class="form-group">
                    <label for="name">Telefone</label>
                    <input type="text" class="form-control" name="telefone" value="<?php echo $brand['telefone'] ?>" placeholder="Insira um telefone...">
                </div>

                <div class="form-group">
                    <label for="name">Celular</label>
                    <input type="text" class="form-control" name="celular" value="<?php echo $brand['celular'] ?>" placeholder="Insira um celular...">
                </div>

                <div class="form-group">
                    <label for="name">Endereço</label>
                    <input type="text" class="form-control" name="address" value="<?php echo $brand['address'] ?>" placeholder="Insira o endereço do Fornecedor...">
                </div>

                <div class="form-group">
                    <label for="name">E-mail</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $brand['email'] ?>" placeholder="Insira um email válido...">
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>
</div>
