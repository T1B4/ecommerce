<div class="panel-heading" style="background-color: #FFF; box-shadow: 0 0 8px 3px rgba(0,0,0,0.1);">
    <h2>Listagem de Usuários</h2>
    <h4>Exibindo usuários de um total de <?php echo $totalItems; ?> cadastrados.</h4>
</div>

<div class="row" style="background-color: #FFF; padding: 10px; margin: 10px 10px 0 10px; border-bottom: 1px solid #724485;">
    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-1 text-center">
        <h4><strong>Cód. Usuário</strong></h4>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-1 col-lg-2 text-center">
        <h4><strong>Nome</strong></h4>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-1 col-lg-1 text-center">
        <h4><strong>CPF</strong></h4>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 text-center">
        <h4><strong>Endereço</strong></h4>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
        <h4><strong>Telefone</strong></h4>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-3 text-center">
        <h4><strong>Email</strong></h4>
    </div>

    <div style="clear: both;"></div>
</div>

<?php foreach ($users as $user): ?>
    <div class="row" style="background-color: #FFF; padding: 10px; margin: 0 10px; border-bottom: 1px solid #724485;">
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-1 text-center">
            <div><?php echo $user['id']; ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-1 col-lg-2 text-center">
            <div><?php echo $user['name']; ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-1 col-lg-1 text-center">
            <div><?php echo $user['cpf']; ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 text-center">
        	<?php if (isset($user['street'])): ?>
        		<div><?php echo $user['street'] .', ' . $user['num'] .' - ' . $user['district'] .' - ' .  $user['state'] .' - ' .  $user['city']; ?></div>
        	<?php endif ?>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
            <div><?php echo $user['telephone']; ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-3 text-center">
            <div><?php echo $user['email']; ?></div>
        </div>
        <div style="clear: both;"></div>
    </div>
<?php endforeach ?>

<div style="margin: 20px 32px 10px 32px;">
    <?php for ($q = 1; $q <= $numberOfPages; $q++): ?>
        <div class="btn btn-info <?php echo ($currentPage == $q) ? 'pag_active' : ''; ?>" style="box-shadow: 0 0 8px 3px rgba(0,0,0,0.1);"><a href="<?php echo BASE_PAINEL; ?>?<?php
            $pag_array = $_GET;
            $pag_array['p'] = $q;
            echo http_build_query($pag_array);
            ?>" style="color: #FFF; display: block;"><?php echo $q; ?></a></div>
        <?php endfor; ?>
</div>