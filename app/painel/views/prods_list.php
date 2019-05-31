<div class="panel-heading" style="background-color: #FFF; box-shadow: 0 0 8px 3px rgba(0,0,0,0.1);">
    <h3>Listagem de Produtos</h3>
</div>
<br>

<div class="box box-primary">
    <form action="<?= BASE_URL; ?>products/search" method="GET" role="form">
        <label for="s" style="margin-left: 10px;">Buscar Produtos</label>
        <div class="input-group input-group-sm" style="padding: 10px;">
            <input type="text" class="form-control" name="s">
            <span class="input-group-btn">
                <input type="submit" class="btn btn-info btn-flat" name="Buscar" value="Buscar!">
            </span>
        </div>
    </form>
</div>

<?php if (isset($mensagem)): ?>
    <div>
        <h3 class="alert alert-success"><?php echo $mensagem; ?></h3>
    </div>
<?php endif ?>

<div class="row" style="background-color: #FFF; padding: 10px; margin: 10px 10px 0 10px; border-bottom: 1px solid #724485;">
    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
        <div><strong>Imagem</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-1 col-lg-1 text-center">
        <div><strong>Código</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
        <div><strong>Nome</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
        <div><strong>Preço</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-1 col-lg-1 text-center">
        <div><strong>Estoque</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
        <div><strong>Ações</strong></div>
    </div>

    <div style="clear: both;"></div>
</div>

<?php foreach ($prods as $prod): ?>
    <?php ($prod['id'] < 10)? $cc = 0: $cc = '' ; ?>
    <div class="row" style="background-color: #FFF; padding: 10px; margin: 0 10px; border-bottom: 1px solid #724485;">
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center" style="position: relative;">
            <img src="<?php echo BASE_MEDIA; ?><?php echo $cc.$prod['id']; ?>/<?php echo $prod['images'][0]['url']; ?>" alt="<?php echo $prod['name']; ?>" height="70">
            <?php if ($prod['status'] == 1): ?>
                <div style="position: absolute; top: 20px; left: 0; right: 0; width: 100%; height: 24px; line-height: 24px; background-color: rgba(244,67,54,.65); color: #FFF;">Anuncio Pausado</div>
            <?php endif ?>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-1 col-lg-1 text-center">
            <div style="line-height: 65px;"><?php echo $prod['code']; ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
            <div style="line-height: 65px;"><?php echo $prod['name']; ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
            <div style="line-height: 65px;">R$ <?php echo number_format($prod['price'], 2, ',', '.'); ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-1 col-lg-1 text-center">
            <div style="line-height: 65px;"><?php echo $prod['stock']; ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
            <span><a href="<?php echo BASE_PAINEL ?>products/edit/<?php echo $prod['id'] ?>"><span class="btn btn-sm btn-info">Editar</span></a></span>
            <span><a href="<?php echo BASE_PAINEL ?>products/del/<?php echo $prod['id'] ?>"><span class="btn btn-sm btn-danger">Excluir</span></a></span>
            <span>
                <a href="<?php echo BASE_PAINEL ?>products/pause/<?php echo $prod['id'] ?>">
                    <?php if ($prod['status'] == 1): ?>
                        <span class="btn btn-sm btn-success">Exibir</span>
                    <?php else: ?>
                        <span class="btn btn-sm btn-primary">Pausar</span>
                    <?php endif; ?>
                </a>
            </span>
        </div>
        <div style="clear: both;"></div>
    </div>
<?php endforeach ?>

<div style="margin: 20px 32px 10px 32px;">
    <?php for ($q = 1; $q <= $numberOfPages; $q++): ?>
        <div class="btn btn-info <?php echo ($currentPage == $q) ? 'pag_active' : ''; ?>" style="box-shadow: 0 0 8px 3px rgba(0,0,0,0.1);"><a href="<?php echo BASE_URL; ?>?<?php
        $pag_array = $_GET;
        $pag_array['p'] = $q;
        echo http_build_query($pag_array);
        ?>" style="color: #FFF; display: block;"><?php echo $q; ?></a></div>
    <?php endfor; ?>
</div>