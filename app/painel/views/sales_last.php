s<div class="panel-heading" style="background-color: #FFF; box-shadow: 0 0 8px 3px rgba(0,0,0,0.1);">
    <h2>Listagem das ultimas 10 Vendas</h2>
</div>
<?php if (isset($mensagem)): ?>
    <div>
        <h3 class="alert alert-success"><?php echo $mensagem; ?></h3>
    </div>
<?php endif ?>

<div class="row" style="background-color: #FFF; padding: 10px; margin: 10px 10px 0 10px; border-bottom: 1px solid #724485;">
    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-1 text-center">
        <div style="line-height: 26px;"><strong>Id Venda</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-1 col-lg-1 text-center">
        <div style="line-height: 26px;"><strong>Id Usuário</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 text-center">
        <div style="line-height: 26px;"><strong>Total da Venda</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 text-center">
        <div style="line-height: 26px;"><strong>Forma de Pagamento</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
        <div style="line-height: 26px;"><strong>Status do Pagamento</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-1 col-lg-2 text-center">
        <div style="line-height: 26px;"><strong>Código de Rastreio</strong></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
        <div style="line-height: 26px;"><strong>Ações</strong></div>
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

        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
            <div><?php echo $sale['payment_type']; ?></div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
           <div><?php
                if ($sale['payment_status'] == 1) {
                    echo "Aguardando Pagamento";
                } elseif($sale['payment_status'] == 3) {
                    echo "Pagamento Aprovado";
                } else {
                    echo "Pagamento Recusado e/ou Cancelado";
                }
            ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-1 col-lg-2 text-center">
            <div>
                <?php if (isset($sale['shipping_code']) && !empty($sale['shipping_code'])) {
                    echo $sale['shipping_code'];
                } else {
                    echo "<div>
                                <form class='form form-inline' action='".BASE_PAINEL."sales/setShipping' method='post'>
                                <div class='input-group'>
                                  <input class='form-control' type='hidden' name='purchase_id' value='". $sale['id']."'>
                                    <input class='form-control' type='text' name='shipping_code' placeholder='Inserir Código de Rastreio'>
                                  <span class='input-group-btn'>
                                    <button class='btn btn-primary' type='submit'>Enviar!</button>
                                  </span>
                                </div>
                                </form>
                          </div>";
                } ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-1 col-lg-2 text-center">
            <div><a href="<?php echo BASE_PAINEL; ?>sales/see_sale/<?php echo $sale['id'] ?>">Ver Pedido</a></div>
        </div>
        <div style="clear: both;"></div>
    </div>
<?php endforeach ?>