<script>
	fbq('track', 'AddToCart');
</script>

<section>
	<h1 class="hidden">Carrinho de Compras</h1>
	<div class="container">
		<?php if (isset($list) && !empty($list)): ?>
		<article>
			<h1 class="hidden">Produtos no Carrinho</h1>
			<h2 class="page-title text-center">Carrinho de Compras</h2>
			<div class="section-div"></div>
			<div class="row text-center d-none d-lg-flex mt-5">
				<div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
					<b>Produto(s)</b>
				</div>
				<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
					<b>Quantidade</b>
				</div>
				<div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
					<b>Valor Unitário</b>
				</div>
				<div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
					<b>Subtotal</b>
				</div>
			</div>

			<?php $subtotal = 0;?>
			<?php $total = 0;?>


			<?php foreach ($list as $item): ?>
			<?php if ($item['stock'] <= 0) {
				$_SESSION['date'] = 15;
			} elseif ($item['stock'] > 0) {
				if (empty($_SESSION['date']) || $_SESSION['date'] < 15) {
					$_SESSION['date'] = 2;
				}
			}
			?>
			<div class="row align-items-center border pt-4 pb-4">

				<?php $subtotal = (floatval($item['price']) * intval($item['qt']));?>
				<?php $total += $subtotal;?>

				<?php ($item['id'] < 10) ? $cc = 0 : $cc = '';?>

				<div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
					<div class="row align-items-center">
						<div class="col-4">
							<a href="<?=ROOT_URL;?><?=$item['category_slug'];?>/<?php echo $item['slug']; ?>">
								<img style="width: 100px;"
									src="<?php echo BASE_URL; ?>media/products/<?php echo $cc . $item['id']; ?>/<?php echo $item['image']; ?>"
									alt="Foto de <?php echo $item['name']; ?>"
									title="Foto de <?php echo $item['name']; ?>">
							</a>
						</div>
						<div class="col-8 text-center">
							<span>
								<?php echo strtoupper($item['name']); ?>
							</span>
						</div>
					</div>
				</div>

				<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 text-center">
					<form method="POST" action="<?php echo ROOT_URL; ?>cart/update">
						<input type="hidden" name="id_product" value="<?php echo $item['id']; ?>" />
						<input type="number" name="qt_product" class="text-center" style="width: 40px; height: 32px; "
							value="<?php echo $item['qt']; ?>" title="Insira a quantia que deseja desse produto.">
						<input type="submit" class="btn btn-sm btn-warning text-white" value="Alterar"
							title="Alterar a Quantia na Cesta" />
						<a class="btn btn-small red" href="<?php echo ROOT_URL; ?>cart/del/<?php echo $item['id']; ?>"
							title="Remover da Cesta">
							<img src="<?php echo BASE_URL; ?>assets/img/delete-button.png" alt="Remover da Cesta">
						</a>
					</form>
				</div>

				<div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 text-center">
					<img src="<?php echo BASE_URL; ?>assets/img/boleto.jpg" alt="Forma de Pagamento Boleto"> R$
					<?php echo number_format($item['price'], 2, ',', '.'); ?>
					<br>
					<img src="<?php echo BASE_URL; ?>assets/img/credit-card.png" alt="Forma de Pagamento Boleto"> 6x de
					R$
					<?php echo number_format($item['price_from'] / 6, 2, ',', '.'); ?>
				</div>

				<div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 text-center">
					<b class="text-danger">R$
						<?php echo number_format($subtotal, 2, ',', '.'); ?>
					</b>
				</div>

				<div class="col-12 mt-3">
					<?php if (!empty($item['mensagem'])): ?>
					<div class="alert alert-primary">
						<?php echo $item['mensagem']; ?>
					</div>
					<?php endif;?>
				</div>

			</div>
			<?php endforeach;?>
		</article>

		<article class="row align-items-center border">
			<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-center p-4">
				<div>
					<?php if (isset($shipping) && !empty($shipping)): ?>

					<div class='row'>

						<?php foreach ($shipping as $correio): ?>

						<div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">

							<?php if (!empty($correio['mensagem'])): ?>

							<div class="alert alert-info">Envio por <?php echo $correio['type'] ?> indisponivel!</div>

							<?php elseif (!empty($correio['price'])): ?>
							<div class="form-check">

								<input type="hidden" value="<?php echo $correio['price']; ?>">

								<input class="form-check-input"
									style="position: relative !important; margin-left: 0 !important;" type="radio"
									name="frete" id="<?php echo $correio['type']; ?>"
									value="<?php echo $correio['type']; ?>">
								<br>

								<?php if ($correio['price'] == 0): ?>

								<label for="alert">

									<div class="alert alert-success"><?php echo $correio['type']; ?><br>Frete Grátis!
									</div>

								</label>

								<?php else: ?>

								<label class="form-check-label" for="<?php echo $correio['type']; ?>">
									<b>
										<?php echo $correio['type']; ?>
									</b>
									<div>R$
										<?php echo number_format($correio['price'], 2, ',', '.'); ?>
									</div>
									<small>Entrega aprox:
										<?php echo $_SESSION['date'] + $correio['date']; ?>
										<?php echo ($correio['type'] == 'TRANSPORTADORA') ? '.' : ' dias úteis.'; ?>
									</small>
								</label>

								<?php endif?>

							</div>

							<?php else: ?>

							<div class="alert alert-info">Envio por <?php echo $correio['type'] ?> indisponivel!</div>

							<?php endif?>

						</div>

						<?php endforeach?>

					</div>

					<a class="btn btn-dark text-white mt-5"
						href="<?php echo ROOT_URL; ?>cart/recalculate_shipping">Recalcular Frete</a>

					<?php elseif (isset($shipping['frete'])): ?>
					<b>
						<?php echo $shipping['frete']; ?>
					</b>

					<?php else: ?>
					<h2>Calcule o Frete</h2>
					<form method="POST" class="form">
						<input class="form-control" type="text" name="cep" placeholder="Digite seu CEP...">
						<br />
						<input class="btn btn-lg btn-success" type="submit" value="Calcular">
					</form>
					<?php endif;?>
				</div>
			</div>

			<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-center p-4">
				<div>
					<div>
						<b>
							<?php echo array_sum($_SESSION['cart']) ?> Produtos</b> - R$
						<?php echo number_format($total, 2, ',', '.'); ?>
					</div>

					<div id="frete">Frete :</div>

					<?php
$frete = 0;
?>

					<input type="hidden" name="total" id="total" value="<?php echo $total; ?>">

					<br>
					<h3 class="page-title text-dark" id="cart-total">Total
						<b>R$
							<?php echo number_format($total, 2, ',', '.'); ?>
						</b>
					</h3>

					<br>

					<?php if (!isset($shipping['frete']) && empty($shipping['mensagem'])): ?>
					<div>
						<form method="POST" action="<?php echo ROOT_URL; ?>cart/payment_redirect">
							<input type="hidden" name="payment_type" value="pagseguro">
							<input type="hidden" name="shipping_type" id="shipping-type" value="">
							<input class="cart-submit btn btn-lg btn-success text-white hidden" id="finalizar"
								type="submit" value="Finalizar Compra">
						</form>
					</div>
					<?php endif;?>
				</div>
			</div>
		</article>
		<br>

		<div class="row align-items-center">
			<div class="col-12 col-sm-12 col-md-12 col-lg-6 offset-lg-6 col-xl-6 offset-xl-6 text-center">
				<a class="btn btn-lg btn-outline-danger" href="<?php echo ROOT_URL; ?>">CONTINUAR COMPRANDO</a>
			</div>
		</div>

		<br>

	</div>

	<?php else : ?>

	<div class="container">
		<div class="row align-items-center">
			<div class="text-center mt-5">
				<img src="<?php echo BASE_URL; ?>assets/img/empty-cart.png" alt="Carrinho de compras vazio.">
				<h3 class="px-5 mx-5 text-center text-muted">Ah que pena, seu carrinho de compras ainda não tem nenhum
					item,
					adicione produtos ao seu carrinho e veja aqui opções de pagamento e frete!</h3>
			</div>
		</div>
	</div>
	<?php endif ;?>

	<?php if (isset($relacionados) && !empty($relacionados)): ?>
	<section class="container home-section mt-5">
		<h1 class="text-center section-title">Produtos que você também pode gostar!</h1>
		<div class="section-div"></div>
		<div class="row">
			<?php foreach ($relacionados as $relacionado): ?>
			<?php $this->loadView('prod_item', $relacionado);?>
			<?php endforeach?>
		</div>

	</section>
	<?php endif?>


	<div id="load"
		style="position: fixed; left: 0; top: 0; width: 100%; height: 100%; display: none; background-color: rgba(0,0,0,0.6); z-index: 9999; ">
		<div class='text-center'
			style="width: 300px; height: 100px; margin-left: calc(50% - 150px); margin-top: calc(25% - 50px); background-color: rgba(0,0,0,0.75); border-radius: 5px; ">
			<div>
				<h2 class='text-center' style='color: #FFFFFF; padding-top: 34px;'>Processando...</h2>
			</div>
		</div>
	</div>
</section>