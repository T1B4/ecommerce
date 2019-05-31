<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">

    <div class="box box-primary">

        <?php if (isset($mensagem)): ?>
            <div id="mensagem">
                <h3 class="alert alert-success" style="margin: 10px 10px;"><?php echo $mensagem; ?></h3>
            </div>
        <?php endif ?>

        <div class="box-header with-border">
            <h3 class="box-title">Editar Categoria</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST">
            <div class="box-body">

                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="hidden" value="<?php echo $cat['id']; ?>" name="id">
                    <input type="text" class="form-control" name="name" value="<?php echo $cat['name']; ?>" required>
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Alterar</button>
            </div>
        </form>
    </div>
</div>
