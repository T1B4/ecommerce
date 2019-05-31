<div class="panel-heading" style="background-color: #FFF; box-shadow: 0 0 8px 3px rgba(0,0,0,0.1);">
    <h3 style="font-weight: 600; text-align: center;">Controle de Estoque</h3>
</div>
<?php if (isset($mensagem)): ?>
    <div id="mensagem">
        <h3 class="alert alert-success" style="margin: 0 10px;"><?php echo $mensagem; ?></h3>
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
    <?php ($prod['id'] < 10)? $cc = 0:$cc = '' ; ?>
    <div class="row" style="background-color: #FFF; padding: 10px; margin: 0 10px; border-bottom: 1px solid #724485;">
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
            <img src="<?php echo BASE_SITE; ?>media/products/<?php echo $cc.$prod['id']; ?>/<?php echo $prod['images'][0]['url']; ?>" alt="<?php echo $prod['name']; ?>" height="70">
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
            <div style="line-height: 65px;"><span><?php echo $prod['stock']; ?></span></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
            <form method="post" class="form form-inline" style="line-height: 65px;">
                <input type="hidden" name="id" value="<?php echo $prod['id']; ?>">
                <input type="text" class="form-control" name="qtde" style="width: 50px; margin: 0 auto;">
                <input type="submit" class="form-control btn btn-xs btn-primary" value="Atualizar">
            </form>
        </div>
        <div style="clear: both;"></div>
    </div>
<?php endforeach ?>

<div class="row" style="margin: 10px; padding: 0 10px;">
    <h3 class="bg-danger" style="padding: 20px; ">O controle de estoque é feito acrescentando ou removendo itens, o numero colocado nos campos serão somados ou subtraidos do estoque atual, para diminuir basta colocar o sinal de menos ( - ) antes do valor. A atualização é feita um item por vez.</h3>
</div>

<div style="margin: 20px 32px 10px 32px;">
    <?php for ($q = 1; $q <= $numberOfPages; $q++): ?>
        <div class="btn btn-info <?php echo ($currentPage == $q) ? 'pag_active' : ''; ?>" style="box-shadow: 0 0 8px 3px rgba(0,0,0,0.1);"><a href="<?php echo BASE_PAINEL; ?>?<?php
            $pag_array = $_GET;
            $pag_array['p'] = $q;
            echo http_build_query($pag_array);
            ?>" style="color: #FFF; display: block;"><?php echo $q; ?></a></div>
        <?php endfor; ?>
</div>

