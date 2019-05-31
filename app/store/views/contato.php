<div class="container">
	<section class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
			<div>

				<br>


				<div class="text-center">
					<h1 class="form-title">Formulário de Contato</h1>
				</div>

				<div class="section-div"></div>

				<br>


				<form method="post" class="form">

					<?php if (isset($mensagem)): ?>
						<div id="mensagem">
							<h3><?php echo $mensagem; ?></h3>
						</div>
					<?php endif ?>

					<div class="form-group">
						<label>Nome</label>
						<input class="form-control" name="nome" type="text" required>
					</div>

					<div class="form-group">
						<label>Email</label>
						<input class="form-control" name="email" type="email" required>
					</div>

					<div class="form-group">
						<label>Mensagem</label>
						<textarea class="form-control" name="mensagem" required></textarea>
					</div>

					<br>

					<div class="text-center form-group">
						<input type="submit" class="form-control btn btn-primary" value="Enviar Mensagem">
					</div>

				</form>
			</div>
		</div>
	</section>
</div>
