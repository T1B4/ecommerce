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
			<h2 class="text-center">Dados Pessoais</h2>
			<p class="text-center">Para alterar os dados basta preencher qualquer um dos campos e clicar em atualizar logo abaixo!</p>
			<?php if (isset($mensagem) && !empty($mensagem)): ?>
				<div><?php echo $mensagem; ?></div>
			<?php endif ?>
			<form method="POST" class="form">

				<div class="form-group">
					<label for="name">Nome</label>
					<input class="form-control" name="name" type="text" disabled value="<?php echo $user_data[0]['name']; ?>">
				</div>

				<div class="form-group">
					<label for="name">Email</label>
					<input class="form-control" name="email" type="text" disabled value="<?php echo $user_data[0]['email']; ?>">
				</div>

				<div class="form-group">
					<label for="name">Rua</label>
					<input class="form-control" name="street" type="text" value="<?php echo $user_data[0]['street']; ?>">
				</div>

				<div class="form-group">
					<label for="name">Numero</label>
					<input class="form-control" name="number" type="text" value="<?php echo $user_data[0]['num']; ?>">
				</div>

				<div class="form-group">
					<label for="name">Bairro</label>
					<input class="form-control" name="district" type="text" value="<?php echo $user_data[0]['district']; ?>">
				</div>

				<div class="form-group">
					<label for="name">Cidade</label>
					<input class="form-control" name="city" type="text" value="<?php echo $user_data[0]['city']; ?>">
				</div>

				<?php
				$estados = ['AC' => 'Acre',
				'AL'=>'Alagoas',
				'AP'=>'Amapá',
				'AM'=>'Amazonas',
				'BA'=>'Bahia',
				'CE'=>'Ceará',
				'DF'=>'Distrito Federal',
				'ES'=>'Espírito Santo',
				'GO'=>'Goiás',
				'MA'=>'Maranhão',
				'MT'=>'Mato Grosso',
				'MS'=>'Mato Grosso do Sul',
				'MG'=>'Minas Gerais',
				'PA'=>'Pará',
				'PB'=>'Paraíba',
				'PR'=>'Paraná',
				'PE'=>'Pernambuco',
				'PI'=>'Piauí',
				'RJ'=>'Rio de Janeiro',
				'RN'=>'Rio Grande do Norte',
				'RS'=>'Rio Grande do Sul',
				'RO'=>'Rondônia',
				'RR'=>'Roraima',
				'SC'=>'Santa Catarina',
				'SP'=>'São Paulo',
				'SE'=>'Sergipe',
				'TO'=>'Tocantins'];

				$name = '';

				foreach ($estados as $key => $value) {
					if ($key == $user_data[0]['state']) {
						$name = $value;
					}
				}

				?>

				<div class="form-group">
					<select name="state" required class="form-control">
						<option value="<?php echo $user_data[0]['state']; ?>" selected><?php echo $name; ?></option>
						<option value="AC">Acre</option>
						<option value="AL">Alagoas</option>
						<option value="AP">Amapá</option>
						<option value="AM">Amazonas</option>
						<option value="BA">Bahia</option>
						<option value="CE">Ceará</option>
						<option value="DF">Distrito Federal</option>
						<option value="ES">Espírito Santo</option>
						<option value="GO">Goiás</option>
						<option value="MA">Maranhão</option>
						<option value="MT">Mato Grosso</option>
						<option value="MS">Mato Grosso do Sul</option>
						<option value="MG">Minas Gerais</option>
						<option value="PA">Pará</option>
						<option value="PB">Paraíba</option>
						<option value="PR">Paraná</option>
						<option value="PE">Pernambuco</option>
						<option value="PI">Piauí</option>
						<option value="RJ">Rio de Janeiro</option>
						<option value="RN">Rio Grande do Norte</option>
						<option value="RS">Rio Grande do Sul</option>
						<option value="RO">Rondônia</option>
						<option value="RR">Roraima</option>
						<option value="SC">Santa Catarina</option>
						<option value="SP">São Paulo</option>
						<option value="SE">Sergipe</option>
						<option value="TO">Tocantins</option>
					<label>Selecione um Estado</label>
					</select>
				</div>

				<div class="form-group">
					<label for="name">Telefone</label>
					<input class="form-control" name="telephone" type="text" value="<?php echo $user_data[0]['telephone']; ?>">
				</div>

				<div class="form-group">
					<label for="name">Celular</label>
					<input class="form-control" name="celular" type="text" value="<?php echo $user_data[0]['celular']; ?>">
				</div>

				<div class="text-center form-group">
					<input class="form-control btn btn-primary" type="submit" value="Atualizar">
				</div>

			</form>
		</div>
	</div>
</section>