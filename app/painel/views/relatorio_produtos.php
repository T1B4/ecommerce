<div class="panel-heading d-print-flex p-row" style="background-color: #FFF; box-shadow: 0 0 8px 3px rgba(0,0,0,0.1);">
    <h3>Relatório de Produtos e Estoque</h3>
</div>


<div class="row p-row d-print-flex" style="background-color: #FFF; padding: 10px; margin: 10px 10px 0 10px; border-bottom: 1px solid #724485;">
    <div class="col-xs-12 col-sm-4 col-md-1 col-lg-2 text-center p-col-2">
        <div><strong>Código</strong></div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-5 text-center p-col-5">
        <div><strong>Nome</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center p-col-2">
        <div><strong>Preço à vista</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center p-col-2">
        <div><strong>Preço à prazo</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-1 col-lg-1 text-center p-col-1">
        <div><strong>Estoque</strong></div>
    </div>

    <div style="clear: both;"></div>
</div>

<?php foreach ($prods as $prod): ?>
    <div class="row d-print-flex p-row" style="background-color: #FFF; padding: 10px; margin: 0 10px; border-bottom: 1px solid #724485;">
        <div class="col-xs-12 col-sm-4 col-md-1 col-lg-2 text-center p-col-2">
            <div style="line-height: 30px;"><?php echo $prod['code']; ?></div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-5 text-center p-col-5">
            <div style="line-height: 30px;"><?php echo $prod['name']; ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center p-col-2">
            <div style="line-height: 30px;">R$ <?php echo number_format($prod['price'], 2, ',', '.'); ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center p-col-2">
            <div style="line-height: 30px;">R$ <?php echo number_format($prod['price_from'], 2, ',', '.'); ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-1 col-lg-1 text-center p-col-1">
            <div style="line-height: 30px;"><?php echo $prod['stock']; ?></div>
        </div>
        <div style="clear: both;"></div>
    </div>
<?php endforeach ?>
</div>