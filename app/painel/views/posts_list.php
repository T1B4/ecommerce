<div class="panel-heading" style="background-color: #FFF; box-shadow: 0 0 8px 3px rgba(0,0,0,0.1);">
    <h2>Todos os Posts do Blog</h2>
</div>
<?php if (isset($mensagem)): ?>
    <div>
        <h3 class="alert alert-success"><?php echo $mensagem; ?></h3>
    </div>
<?php endif ?>

<div class="row" style="background-color: #FFF; padding: 10px; margin: 10px 10px 0 10px; border-bottom: 1px solid #724485;">
    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
        <h4 style="line-height: 26px;"><strong>Imagem</strong></h4>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-1 col-lg-2 text-center">
        <h4 style="line-height: 26px;"><strong>Titulo</strong></h4>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 text-center">
        <h4 style="line-height: 26px;"><strong>Subtitulo</strong></h4>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-4 text-center">
        <h4 style="line-height: 26px;"><strong>Texto</strong></h4>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
        <h4 style="line-height: 26px;"><strong>Ações</strong></h4>
    </div>

    <div style="clear: both;"></div>
</div>

<?php foreach ($posts as $post): ?>
    <div class="row" style="background-color: #FFF; padding: 10px; margin: 0 10px; border-bottom: 1px solid #724485;">
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
            <img src="<?php echo BASE_SITE; ?>blog/media/<?php echo $post['imgs'][0]['post_img_url']; ?>" alt="<?php echo $post['post_titulo']; ?>" height="100">
        </div>
        <div class="col-xs-12 col-sm-4 col-md-1 col-lg-2 text-center">
            <h4><?php echo $post['post_titulo']; ?></h4>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 text-center">
            <h4><?php echo $post['post_subtitulo']; ?></h4>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-4 text-center">
            <h4><?php echo substr($post['post_texto'], 0, 100); ?> ... <small>continua</small></h4>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
            <span><a href="<?php echo BASE_PAINEL ?>blog/edit/<?php echo $post['post_id'] ?>"><img src="<?php echo BASE_PAINEL ?>assets/img/edit.png" alt="Editar" title="Editar Produto" height="24" style="margin-top: 38px;"></a></span>
            <span><a href="<?php echo BASE_PAINEL ?>blog/del/<?php echo $post['post_id'] ?>"><img src="<?php echo BASE_PAINEL ?>assets/img/error.png" alt="Editar" title="Excluir Produto" height="24" style="margin-top: 38px; margin-left: 20px;" alt="Excluir Produto"></a></span>
        </div>
        <div style="clear: both;"></div>
    </div>
<?php endforeach ?>