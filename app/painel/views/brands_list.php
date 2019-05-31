<div class="panel-heading" style="background-color: #FFF; box-shadow: 0 0 8px 3px rgba(0,0,0,0.1);">
    <h3>Listagem de Fornecedores</h3>
</div>

<div class="row" style="background-color: #FFF; padding: 10px; margin: 10px 10px 0 10px; border-bottom: 1px solid #724485;">
    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-1 text-center">
        <div><strong>Cód. Fornecedor</strong></div>
    </div>

    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 text-center">
        <div><strong>Nome</strong></div>
    </div>

    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 text-center">
        <div><strong>Endereço</strong></div>
    </div>

    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 text-center">
        <div><strong>E-mail</strong></div>
    </div>

    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 text-center">
        <div><strong>Telefone</strong></div>
    </div>

    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 text-center">
        <div><strong>Celular</strong></div>
    </div>

    <div style="clear: both;"></div>
</div>

<?php foreach ($brands as $brand): ?>
    <div class="row" style="background-color: #FFF; padding: 10px; margin: 0 10px; border-bottom: 1px solid #724485;">

        <div class="col-xs-12 col-sm-4 col-md-1 col-lg-1 text-center">
            <div><?php echo $brand['id']; ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 text-center">
            <div><?php echo $brand['name']; ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 text-center">
            <div><?php echo $brand['address']; ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 text-center">
            <div><?php echo $brand['email']; ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 text-center">
            <div><?php echo $brand['telefone']; ?></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 text-center">
            <div><?php echo $brand['celular']; ?></div>
            <a href="<?php echo BASE_PAINEL; ?>brands/edit/<?php echo $brand['id'] ?>"><img src="<?php echo BASE_URL; ?>assets/img/edit.png" style="width: 18px; height: auto;" alt="Editar Fornecedor"></a>
        </div>

        <div style="clear: both;"></div>
    </div>
<?php endforeach ?>