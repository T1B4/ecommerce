<div class="panel-heading" style="background-color: #FFF; box-shadow: 0 0 8px 3px rgba(0,0,0,0.1);">
    <h2>Vendas com Pagamentos Recusados</h2>
</div>
<?php if (isset($mensagem)): ?>
    <div>
        <h3 class="alert alert-success"><?php echo $mensagem; ?></h3>
    </div>
<?php endif ?>

<div class="row" style="background-color: #FFF; padding: 10px; margin: 10px 10px 0 10px; border-bottom: 1px solid #724485;">
    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-1 text-center">
        <div style="line-height: 26px;"><strong>Código da Venda</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-1 col-lg-1 text-center">
        <div style="line-height: 26px;"><strong>Código do Usuário</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 text-center">
        <div style="line-height: 26px;"><strong>Total da Venda</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 text-center">
        <div style="line-height: 26px;"><strong>Produtos Vendidos</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
        <div style="line-height: 26px;"><strong>Forma de Pagamento</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-1 col-lg-1 text-center">
        <div style="line-height: 26px;"><strong>Status do Pagamento</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
        <div style="line-height: 26px;"><strong>Código de Rastreio</strong></div>
    </div>

    <div style="clear: both;"></div>
</div>

<?php foreach ($sales as $sale): ?>
    <div class="row" style="background-color: #FFF; padding: 10px; margin: 0 10px; border-bottom: 1px solid #724485;">
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-1 text-center">
            <div><?php echo $sale['id']; ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-1 col-lg-1 text-center">
            <div><?php echo $sale['id_user']; ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 text-center">
            <div>R$ <?php echo number_format($sale['total_amount'], 2, ',', '.'); ?></div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-3 text-center">
            <div>
                <?php foreach ($sale['sales_prods'] as $item): ?>
                    <?php echo "Cod. Prod - " . $item['prod_details']['code']; ?> ||
                    <?php echo "Qtde - " . $item['quantity']; ?><br>
                <?php endforeach ?>
            </div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
            <div><?php echo $sale['payment_type']; ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-1 col-lg-1 text-center">
            <div><?php echo $sale['payment_status']; ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-1 col-lg-2 text-center">
            <div><?php echo $sale['shipping_code']; ?></div>
        </div>
        <div style="clear: both;"></div>
    </div>
<?php endforeach ?>

