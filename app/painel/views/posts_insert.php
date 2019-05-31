<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">

    <div class="box box-primary" style="box-shadow: 3px 3px 6px rgba(0,0,0,0.15);">

        <?php if (isset($mensagem)): ?>
            <div id="mensagem">
                <h3 class="alert alert-success" style="margin: 0 10px;"><?php echo $mensagem; ?></h3>
            </div>
        <?php endif ?>

        <div class="box-header with-border">
            <h3 class="box-title">Inserir Novo Post</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" enctype="multipart/form-data" method="POST">
            <div class="box-body">

                <div class="form-group">
                    <label for="code">Titulo</label>
                    <input type="text" class="form-control" name="titulo" placeholder="Insira o titulo da postagem" required>
                </div>
                <div class="form-group">
                    <label for="name">Subtitulo</label>
                    <input type="text" class="form-control" name="subtitulo" placeholder="Insira o subtitulo da postagem" required>
                </div>

                <div class="frm-group">
                    <label for="categoria">Categoria do Assunto da Postagem</label>
                    <select name="categoria" class="form-control" required>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?php echo $cat['post_cat_id'] ?>" class="form-control"><?php echo $cat['post_cat_nome'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Texto</label>
                    <textarea name="texto" class="form-control" id="editor" rows="20"></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">Selecionar Imagens</label>
                    <input type="file" multiple name="images[]">

                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>
</div>
