<section class="container control-panel">
	<div class="row">
		<div class="col-12" style="margin: 32px 0;">
			<h1 class="text-center">Painel de Controle do Usuário</h1>
			<div class="section-div"></div>
		</div>

		<div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
			<ul class="list-unstyled text-center">
				<a class="btn btn-light btn-control-panel" href="<?php echo ROOT_URL; ?>user/controlPanel"><li class="text-center"><div>Dados Pessoais</div></li></a><br>
				<a class="btn btn-light btn-control-panel" href="<?php echo ROOT_URL; ?>user/changePass"><li class="text-center"><div>Alterar Senha</div></li></a><br>
				<a class="btn btn-light btn-control-panel" href="<?php echo ROOT_URL; ?>user/myPurchases"><li class="text-center"><div>Meus Pedidos</div></li></a><br>
				<a class="btn btn-light btn-control-panel" href="<?php echo ROOT_URL; ?>user/logout"><li class="text-center"><div>Sair</div></li></a>
			</ul>
		</div>

		<div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 border-left">
			<?php ($purchase[0]['id'] < 10)? $c = 0: $c = ''; ?>
			<h2>Detalhes do Pedido - <?= $c.$purchase[0]['id']; ?></h2>
			<hr>

			<div class="row">
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="font-size: 20px;">Forma de Pagamento : <small><?php echo $purchase[0]['payment_type']; ?></small></div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="font-size: 20px;">Status de Pagamento : <small>
					<?php if ($purchase[0]['payment_status'] == 1) {
						echo "Aguardando Pagamento";
					} else {
						echo "Pedido Liberado";
					} ?>
				</small></div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="font-size: 20px;">Endereço de Entrega : <small><?php echo $purchase[0]['shipping_address']; ?></small></div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="font-size: 20px;">Forma de Envio : <small><?php echo $purchase[0]['shipping_type']; ?></small></div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="font-size: 20px;">Código de Rastreio : <small><?php echo ($purchase[0]['shipping_code'])? $purchase[0]['shipping_code']:'Pedido em processamento.' ; ?></small></div>
			</div>

			<hr>

			<div><h2 class="text-center">Produtos comprados</h2></div>

			<hr>

			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 text-center d-none d-lg-block"><b>Imagem</b></div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 text-center d-none d-lg-block"><b>Código</b></div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 text-center d-none d-lg-block"><b>Produto</b></div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 text-center d-none d-lg-block"><b>Preço Unitário</b></div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 text-center d-none d-lg-block"><b>Quantidade</b></div>
			</div>

				<br>

				<?php foreach ($purchase[0]['sales_prods'] as $prod): ?>

					<?php ($prod['prod_details']['id'] < 10)? $c = 0: $c = ''; ?>

					<div class="row align-items-center">
						<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 text-center">
							<img style="width: auto; height: 60px; margin: 0 auto; float: none;" src="<?php echo BASE_URL; ?>media/products/<?php echo $c.$prod['prod_details']['id']; ?>/<?php echo $prod['prod_details']['image']; ?>" alt="<?php echo $prod['prod_details']['name']; ?>">
						</div>
						<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 text-center"><span class="d-lg-none"><b>Código : </b></span><?php echo $prod['prod_details']['code']; ?></div>
						<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 text-center"><span class="d-lg-none"><b>Produto : </b></span>
							<?php echo $prod['prod_details']['name']; ?>
						</div>
						<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 text-center"><span class="d-lg-none"><b>Preço Unitário : </b></span><?php echo "R$ " . number_format($prod['product_price'], 2, ',', '.'); ?></div>
						<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 text-center"><span class="d-lg-none"><b>Qtde : </b></span><?php echo $prod['quantity']; ?></div>
					</div>
					<hr>

				<?php endforeach ?>
		</div>
	</div>
</section>
