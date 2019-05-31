<div class="container">
	<div class="row">
		<form method="POST" class="col-12 col-sm-12 col-md-12 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3 form">
			<br>
			<h1 class="text-center">Criar Novo Usuário</h1>
			<div class="section-div"></div>

			<div class="form-group">
				<label>Nome</label>
				<input class="form-control" type="text" name="name" class="validate"required>
			</div>

			<div class="form-group">
				<label>E-mail</label>
				<input class="form-control" type="email" name="email" class="validate"required />
			</div>

			<div class="form-group">
				<label>Senha</label>
				<input class="form-control" type="password" name="pass" required/>
			</div>

			<div class="form-group">
				<label>CPF</label>
				<input class="form-control" type="text" name="cpf" required/>
			</div>

			<div class="form-group">
				<label>Telefone</label>
				<input class="form-control" type="text" name="telephone" required/>
			</div>

			<h3 class="form-title">Informações de Endereço</h3>

			<div class="form-group">
				<label>CEP</label>
				<input class="form-control" type="text" name="cep" required/>
			</div>

			<div class="form-group">
				<label>Logradouro</label>
				<input class="form-control" type="text" name="street" required/>
			</div>

			<div class="form-group">
				<label>Numero</label>
				<input class="form-control" type="text" name="num" required/>
			</div>

			<div class="form-group">
				<label>Complemento</label>
				<input class="form-control" type="text" name="complement"/>
			</div>

			<div class="form-group">
				<label>Bairro</label>
				<input class="form-control" type="text" name="district" required/>
			</div>

			<div class="form-group">
				<label>Cidade</label>
				<input class="form-control" type="text" name="city" required/>
			</div>

			<div class="form-group">
				<label>Selecione um Estado</label>
				<select required class="form-control" name="state">
					<option value="" disabled selected>Escolha uma Opção</option>
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
				</select>
			</div>

			<div class="text-center">
				<input class="btn btn-lg btn-dark" type="submit" value="Cadastrar">
			</div>

			<br>

		</form>
	</div>
</div>