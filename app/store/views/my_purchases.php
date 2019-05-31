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
			<h2 class="text-center control-panel-subtitle">Meus Pedidos</h2>
			<div class="hide-on-med-and-down">
				<hr>

				<div class="row">
					<div class="col-2 text-center d-none d-lg-block"><b>Pedido</b></div>
					<div class="col-2 text-center d-none d-lg-block"><b>Valor do Pedido</b></div>
					<div class="col-2 text-center d-none d-lg-block"><b>Forma de Pagamento</b></div>
					<div class="col-2 text-center d-none d-lg-block"><b>Status do Pagamento</b></div>
					<div class="col-2 text-center d-none d-lg-block"><b>Código de Rastreio</b></div>
					<div class="col-2 text-center d-none d-lg-block"><b>Detalhes do Pedido</b></div>
				</div>

			</div>
			<hr class="d-none d-lg-block">

			<?php foreach ($purchases as $purchase): ?>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 text-center"><span class="d-lg-none"><b>Pedido : </b></span><?= $purchase['id']; ?></div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 text-center"><span class="d-lg-none"><b>Valor do Pedido : </b></span><?= "R$ " . number_format($purchase['total_amount'], 2, ',', '.'); ?></div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 text-center"><span class="d-lg-none"><b>Forma de Pagamento : </b></span><?= $purchase['payment_type']; ?></div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 text-center"><span class="d-lg-none"><b>Status do Pagamento : </b></span>
						<?php if ($purchase['payment_status'] == 1): ?>
							<div>Aguardando Pagamento</div>
						<?php elseif ($purchase['payment_status'] == 3): ?>
							<div>Pagamento Conluido</div>
						<?php elseif ($purchase['payment_status'] == 7): ?>
							<div>Pagamento Cancelado</div>
						<?php endif; ?>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 text-center"><span class="d-lg-none"><b>Código de Rastreio : </b></span><?php echo ($purchase['shipping_code']) ? $purchase['shipping_code']:'Produto Ainda não Enviado'; ?></div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 text-center"><a class="btn btn-sm btn-warning text-white" href="<?php echo ROOT_URL; ?>user/purchaseDetails/<?= $purchase['id']; ?>">Ver Pedido</a></div>
					<div class="clear"></div>
					<hr>

				</div>


			<?php endforeach ?>

			<br><br>

		</div>
	</div>
</section>
