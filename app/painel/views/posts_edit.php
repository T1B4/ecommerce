<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">

    <div class="box box-primary" style="box-shadow: 3px 3px 6px rgba(0,0,0,0.15);">

        <?php if (isset($mensagem)): ?>
            <div id="mensagem">
                <h3 class="alert alert-success" style="margin: 0 10px;"><?php echo $mensagem; ?></h3>
            </div>
        <?php endif ?>

        <div class="box-header with-border">
            <h3 class="box-title">Editar Postagem</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST">
            <div class="box-body">

                <div class="form-group">
                    <label for="code">Titulo</label>
                    <input type="text" class="form-control" name="titulo" value="<?php echo $post['post_titulo']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="name">Subtitulo</label>
                    <input type="text" class="form-control" name="subtitulo" value="<?php echo $post['post_subtitulo']; ?>" required>
                </div>

                <div class="frm-group">
                    <label for="categoria">Categoria do Assunto da Postagem</label>
                    <select name="categoria" class="form-control" required>
                        <?php foreach ($categorias as $cat): ?>
                            <?php if ($cat['post_cat_id'] == $post['post_cat']){
                                $cond = "selected";
                            } else {
                                $cond = '';
                            } ; ?>
                            <option value="<?php echo $cat['post_cat_id'] ?>" class="form-control" <?= $cond; ?>><?php echo $cat['post_cat_nome'] ?></option>
                            }
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Texto</label>
                    <textarea name="texto" class="form-control" id="editor" rows="20"><?php echo $post['post_texto']; ?></textarea>
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>
</div>
