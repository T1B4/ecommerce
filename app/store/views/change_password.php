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
			<h2 class="center-align control-panel-subtitle">Alterar Senha</h2>

			<form method="POST" class="form">

				<?php if (isset($mensagem_success)): ?>
					<div><?php echo $mensagem_success; ?></div>
				<?php endif ?>

				<?php if (isset($mensagem_error)): ?>
					<div><?php echo $mensagem_error; ?></div>
				<?php endif ?>

				<div class="form-group">
					<label for="name">Senha Antiga</label>
					<input class="form-control input-full" type="password" name="oldpass">
				</div>

				<div class="form-group">
					<label for="name">Nova Senha</label>
					<input class="form-control input-full" type="password" name="newpass">
				</div>

				<div class="form-group">
					<label for="name">Repetir Nova Senha</label>
					<input class="form-control input-full" type="password" name="newpass2">
				</div>

				<div class="text-center form-group">
					<input class="form-control btn btn-primary" type="submit" value="Atualizar">
				</div>
			</form>
		</div>
	</div>
</section>