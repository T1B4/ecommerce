<div class="panel-heading" style="background-color: #FFF; box-shadow: 0 0 8px 3px rgba(0,0,0,0.1);">
    <h3>Categorias de Produtos</h3>
</div>
<?php if (isset($mensagem)): ?>
    <div id="mensagem">
        <h3 class="alert alert-success" style="margin: 0 10px;"><?php echo $mensagem; ?></h3>
    </div>
<?php endif ?>

<div class="row" style="background-color: #FFF; padding: 10px; margin: 10px 10px 0 10px; border-bottom: 1px solid #724485;">
    <div>
        <div class="col-xs-12 col-sm-4 col-md-1 col-lg-1 text-center">
            <div style="font-size: 20px;"><strong>Código</strong></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
            <div style="font-size: 20px;"><strong>Nome</strong></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
            <div style="font-size: 20px;"><strong>Ações</strong></div>
        </div>
    </div>
    <div style="clear: both;"></div>
</div>

<?php foreach ($categories as $cat): ?>
    <div class="row" style="background-color: #FFF; padding: 10px; margin: 0 10px; border-bottom: 1px solid #724485;">
        <div class="col-xs-12 col-sm-4 col-md-1 col-lg-1 text-center">
            <div style="font-size: 16px;"><?php echo $cat['id']; ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div style="font-size: 16px;"><b><?php echo strtoupper($cat['name']); ?></b></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
            <span><a href="<?php echo BASE_PAINEL ?>category/edit/<?php echo $cat['id'] ?>"><span class="btn btn-sm btn-info">Editar</span></a></span>
            <span><a href="<?php echo BASE_PAINEL ?>category/del/<?php echo $cat['id'] ?>"><span class="btn btn-sm btn-danger">Excluir</span></a></span>
        </div>
        <div style="clear: both;"></div>
    </div>

    <?php if (count($cat['subs']) > 0): ?>
        <?php foreach ($cat['subs'] as $subcat): ?>
            <div class="row" style="background-color: #FFF; padding: 10px; margin: 0 10px; border-bottom: 1px solid #724485;">
                <div class="col-xs-12 col-sm-4 col-md-1 col-lg-1 text-center">
                    <div style="font-size: 16px;"><?php echo $subcat['id']; ?></div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div style="font-size: 16px; margin-left: 20px;">-><?php echo $subcat['name']; ?></div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
                    <span><a href="<?php echo BASE_PAINEL ?>category/edit/<?php echo $subcat['id'] ?>"><span class="btn btn-sm btn-info">Editar</span></a></span>
                    <span><a href="<?php echo BASE_PAINEL ?>category/del/<?php echo $subcat['id'] ?>"><span class="btn btn-sm btn-danger">Excluir</span></a></span>
                </div>
                <div style="clear: both;"></div>
            </div>

            <?php if (count($subcat['subs']) > 0): ?>
                <?php foreach ($subcat['subs'] as $subsubcat): ?>
                    <div class="row" style="background-color: #FFF; padding: 10px; margin: 0 10px; border-bottom: 1px solid #724485;">
                        <div class="col-xs-12 col-sm-4 col-md-1 col-lg-1 text-center">
                            <div style="font-size: 16px;"><?php echo $subsubcat['id']; ?></div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div style="font-size: 16px; margin-left: 40px;">---><?php echo $subsubcat['name']; ?></div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
                            <span><a href="<?php echo BASE_PAINEL ?>category/edit/<?php echo $subsubcat['id'] ?>"><span class="btn btn-sm btn-info">Editar</span></a></span>
                            <span><a href="<?php echo BASE_PAINEL ?>category/del/<?php echo $subsubcat['id'] ?>"><span class="btn btn-sm btn-danger">Excluir</span></a></span>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        <?php endforeach ?>
    <?php endif ?>
<?php endforeach ?>
