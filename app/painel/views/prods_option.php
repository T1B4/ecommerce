<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">

    <div class="box box-primary" style="box-shadow: 3px 3px 6px rgba(0,0,0,0.15);">

        <?php if (isset($mensagem)): ?>
<!--             <div id="mensagem">
                <h3 class="alert alert-success" style="margin: 10px;"><?php echo $mensagem; ?></h3>
            </div> -->

            <script>
                    alert("<?php echo $mensagem; ?>");
            </script>

        <?php endif ?>

        <div class="box-header with-border">
            <h3 class="box-title">Inserir Opções para Produtos</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST">
            <div class="box-body">

                <div class="form-group">
                    <label for="code">Opção</label>
                    <input type="text" class="form-control" name="option" placeholder="Insira uma Opção que será adicionada a um ou mais produtos..." required>
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>
</div>
