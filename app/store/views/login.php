<div class="container">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
			<form method="POST" class="form">
				<br>
				<h1 class="text-center">Login</h1>
				<div class="section-div"></div>
				<?php if (isset($mensagem) && !empty($mensagem)): ?>
					<div><h2><?php echo $mensagem; ?></h2></div><br>
				<?php endif ?>

				<div class="form-group">
					<label for="email">E-mail</label>
					<input class="form-control" class="input-full" type="email" name="email" placeholder="Digite seu email..." required>
				</div class="form-group">

				<div class="form-group">
					<label for="password">Senha</label>
					<input class="form-control" class="input-full" type="password" name="pass" placeholder="Digite sua senha..." required>
				</div>

				<div class="text-center">
					<input class="btn btn-lg btn-warning text-white" type="submit" value="ENTRAR">
				</div>

				<br>

				<hr>

				<div class="text-center">
					<h3>Não é cadastrado ainda em nossa Loja? Cadastre-se agora!</h3>
					<a href="<?php echo ROOT_URL; ?>user/newUser" class="btn btn-success">Cadastrar</a>
				</div>

				<br>

			</form>

		</div>
	</div>
</div>