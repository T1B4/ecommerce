<h1>Painel Administrativo</h1>
<h4>Escolha uma funcionalidade de controle no menu a esquerda e abra as opções disponíveis de cada item.</h4>
<div class="col-lg-6">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3><?php echo $total_purchases; ?></h3>

            <p>Total de Vendas</p>
        </div>
        <div class="icon">
            <i class="ion ion-stats-bars"></i>
        </div>
        <a href="<?php echo BASE_PAINEL; ?>sales/see_all" class="small-box-footer">
            Detalhes <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>

<div class="col-lg-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
        <div class="inner">
            <h3>R$ <?php echo number_format($total_amount, 2, ',', '.'); ?></h3>

            <p>Valor Total das Vendas</p>
        </div>
        <div class="icon">
            <i class="fa fa-shopping-cart"></i>
        </div>
        <a href="<?php echo BASE_PAINEL; ?>sales/see_all" class="small-box-footer">
            Detalhes <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>

<div class="col-lg-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h3><?php echo $total_users; ?></h3>

            <p>Usuários Registrados</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="<?php echo BASE_PAINEL; ?>user" class="small-box-footer">
            Detalhes <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>

<div class="col-lg-6">
    <!-- small box -->
    <div class="small-box bg-red">
        <div class="inner">
            <h3><?php echo $total_newsletter; ?></h3>

            <p>Assinantes da Lista de Emails</p>
        </div>
        <div class="icon">
            <i class="ion ion-pie-graph"></i>
        </div>
        <a href="<?php echo BASE_PAINEL; ?>user/newsletter" class="small-box-footer">
            Detalhes <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>