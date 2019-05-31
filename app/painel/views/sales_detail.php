<div class="row" style="margin: 0 10px; background-color: #FFF; padding: 20px;">
	<?php ($sales[0]['id'] < 10)? $c = 0: $c = ''; ?>
	<h1 class="page-header">Detalhes do Pedido - <?= $c.$sales[0]['id']; ?></h1>
	<div>

		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div style="font-size: 24px;">Forma de Pagamento</div>
			<div class="bg-success" style="padding: 5px; font-size: 1.15em;"><?php echo $sales[0]['payment_type']; ?></div>
		</div>

		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div style="font-size: 24px;">Status de Pagamento</div>
			<div class="bg-success" style="padding: 5px; font-size: 1.15em;">
				<?php if ($sales[0]['payment_status'] == 1) {
					echo "Aguardando Pagamento";
				} elseif($sales[0]['payment_status'] == 2) {
					echo "Pedido em Análise";
				} elseif($sales[0]['payment_status'] == 3) {
					echo "Pedido Liberado";
				} elseif($sales[0]['payment_status'] == 4) {
					echo "Pagamento Disponível";
				} elseif($sales[0]['payment_status'] == 5) {
					echo "Pedido em Disputa";
				} elseif($sales[0]['payment_status'] == 6) {
					echo "Pagamento Devolvido";
				} else {
					echo "Pagamento Recusado";
				} ?>
			</div>
		</div>

		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div style="font-size: 24px;">Dados do Comprador</div>
			<div class="bg-success" style="padding: 5px; font-size: 1.15em;">Nome: <?php echo $sales['user']['name']; ?></div>
			<div class="bg-success" style="padding: 5px; font-size: 1.15em;">E-mail: <?php echo $sales['user']['email']; ?></div>
			<div class="bg-success" style="padding: 5px; font-size: 1.15em;">Telefone: <?php echo $sales['user']['telephone']; ?></div>
			<div class="bg-success" style="padding: 5px; font-size: 1.15em;">CPF: <?php echo $sales[0]['cpf']; ?></div>
		</div>

		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div style="font-size: 24px;">Endereço de Entrega</div>
			<div class="bg-success" style="padding: 5px; font-size: 1.15em;"><?php echo $sales[0]['shipping_address']; ?></div>
		</div>

		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div style="font-size: 24px;">Forma de Envio</div>
			<div class="bg-success" style="padding: 5px; font-size: 1.15em;"><?php echo $sales[0]['shipping_type']; ?></div>
		</div>

		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div style="font-size: 24px;">Código de Rastreio</div>
			<small class="bg-success"  style="padding: 5px; font-size: 1.15em;"><?php echo ($sales[0]['shipping_code'])? $sales[0]['shipping_code']:'Pedido em processamento.' ; ?></small>
		</div>


	</div>

	<hr>

	<div class="clearfix"></div>
	<hr>
	<div class="row">
		<h2 class="text-center">Produtos comprados</h2>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-1 col-md-1 col-lg-1 text-center" style="font-size: 20px;">Código</div>
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 text-center" style="font-size: 20px;">Imagem</div>
		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-center" style="font-size: 20px;">Produto</div>
		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-center" style="font-size: 20px;">Preço Unitário</div>
		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-center" style="font-size: 20px;">Quantidade</div>
		<div class="clearfix"></div>
	</div>
	<br>

	<?php $x = 0; ?>
	<?php foreach ($sales[0]['sales_prods'] as $prod): ?>

		<?php ($prod['prod_details']['id'] < 10)? $c = 0: $c = ''; ?>

		<!-- ÁREA DE PREENCHIMENTO DOS DADOS -->
		<div class="row" style="background-color: <?php echo ($x % 2 == 0)? '#e8eaf6':'#FFF'; ?>; padding: 10px 0;">
			<div class="col-xs-12 col-sm-1 col-md-1 col-lg-1 text-center" style="line-height: 60px;"><?php echo $prod['prod_details']['code']; ?></div>
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="line-height: 60px;">
				<img style="width: auto; height: 60px;" class="center-block" src="<?php echo BASE_SITE; ?>media/products/<?php echo $c.$prod['prod_details']['id']; ?>/<?php echo $prod['prod_details']['image']; ?>" alt="<?php echo $prod['prod_details']['name']; ?>">
			</div>
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-center" style="line-height: 60px;">
				<?php echo $prod['prod_details']['name']; ?>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-center" style="line-height: 60px;"><?php echo "R$ " . number_format($prod['product_price'], 2, ',', '.'); ?></div>
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-center" style="line-height: 60px;"><?php echo $prod['quantity']; ?></div>
		</div>
		<!-- FINAL DA ÁREA DE PREENCHIMENTO DOS DADOS -->

		<?php $x++; ?>

		<div class="clearfix"></div>

	<?php endforeach ?>
</div>
