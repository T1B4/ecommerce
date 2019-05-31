<section class="row">
	<div class="col-12 col-sm-12 col-md-12 col-lg-4 offset-lg-4 col-xl-4 offset-xl-4">
		<h1 class="text-center">Finalizar Pagamento</h1>
		<div class="section-div"></div>

		<h3 class="text-center">Dados Pessoais</h3>

		<input type="hidden" name="url" value="<?php echo ROOT_URL; ?>">

		<div class="form-group">
			<label>Nome:</label>
			<input class="form-control" type="text" name="name" required/>
		</div>

		<div class="form-group">
			<label>CPF:</label>
			<input class="form-control" type="text" name="cpf" placeholder="Insira seu CPF" required/>
		</div>

		<div class="form-group">
			<label>Telefone Celular:</label>
			<input class="form-control telephone" type="text" name="telephone" placeholder="Preencha somente com numeros e sem o zero no inicio Ex: 14998195167" required/>
		</div>

		<div class="form-group">
			<label>E-mail:</label>
			<input class="form-control" type="email" name="email" required/>
		</div>

		<div class="form-group">
			<label>Senha:</label>
			<input class="form-control" type="password" name="pass" required/>
		</div>

		<h3 class="text-center">Informações de Endereço</h3>

		<div class="form-group">
			<label>CEP:</label>
			<input class="form-control" id="cep" type="text" name="cep" required/>
		</div>

		<div class="form-group">
			<label>Logradouro:</label>
			<input class="form-control" type="text" id="rua" name="street" placeholder="Rua, Avenida, Alameda, etc..." required/>
		</div>

		<div class="form-group">
			<label>Número:</label>
			<input class="form-control" type="text" id="num" name="num" required/>
		</div>

		<div class="form-group">
			<label>Complemento:</label>
			<input class="form-control" type="text" name="complement" />
		</div>

		<div class="form-group">
			<label>Bairro:</label>
			<input class="form-control" id="bairro" type="text" name="district" required/>
		</div>

		<div class="form-group">
			<label>Cidade:</label>
			<input class="form-control" id="cidade" type="text" name="city" required/>
		</div>

		<div class="form-group">
			<label>Estado:</label>
			<select required name="state" id="estado" class="form-control">
			</div>
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

		<br>

		<h3 class="text-center">Informações de Pagamento</h3><br>

		<select name="pg_form" id="pg_form" onchange="selectPg()" class="form-control">
			<option value="">Selecione o meio de pagamento</option>
			<option value=""></option>
			<option value="CREDIT_CARD">Cartão de Crédito</option>
			<option value="BOLETO">Boleto Bancário</option>
		</select>

		<div id="cc" style="display: none;">

			<div class="form-group">
				<label>Titular do cartão:</label>
				<input class="form-control" type="text" name="cartao_titular" placeholder="Insira o nome como está impresso no cartão"/>
			</div>

			<div class="form-group">
				<label>Data de Nascimento do Titular do Cartão:</label>
				<input class="form-control cartao_aniversario" type="text" name="cartao_aniversario" placeholder="Preencha a data de nascimento completa ex: 05/12/1983"/>
			</div>

			<div class="form-group">
				<label>CPF do Titular do cartão:</label>
				<input class="form-control" type="text" name="cartao_cpf"/>
			</div>

			<div class="form-group">
				<label>Número do cartão:</label>
				<input class="form-control" type="text" name="cartao_numero"/>
			</div>

			<div class="form-group">
				<label>Código de Segurança:</label>
				<input class="form-control" type="text" name="cartao_cvv"/>
			</div>

			<div class="form-group">
				<label>Validade:</label>
				<select class="form-control" style="margin-bottom: 10px;" name="cartao_mes">
					<option value="">Selecione o mês</option>
					<?php for($q=1;$q<=12;$q++): ?>
						<option><?php echo ($q<10)?'0'.$q:$q; ?></option>
					<?php endfor; ?>
				</select>
			</div>

			<div class="form-group">
				<select class="form-control" name="cartao_ano" >
					<?php $ano = intval(date('Y')); ?>
					<option value="">Selecione o ano</option>
					<?php for($q=$ano;$q<=($ano+20);$q++): ?>
						<option><?php echo $q; ?></option>
					<?php endfor; ?>
				</select>
			</div>

			<div class="form-group">
				<label>Parcelas:</label>
				<select class="form-control" name="parc"></select>
			</div>

		</div>

		<input type="hidden" name="total" value="<?php echo $total; ?>" />
		<input type="hidden" name="total_cart" value="<?php echo $total_cart; ?>" />
		<br>

		<button class="btn btn-lg text-white btn-warning efetuarCompra" id="finalizar">Efetuar Compra</button>
		<div class="clear"></div>

		<br>
	</div>
</section>

<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/psckttransparente.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/viacep.js"></script>
<script type="text/javascript">
	PagSeguroDirectPayment.setSessionId("<?php echo $sessionCode; ?>");
</script>

<div id="load" style="position: fixed; left: 0; top: 0; width: 100%; height: 150%; display: none; background-color: rgba(0,0,0,0.6); z-index: 9999; ">
	<div style="width: 600px; height: 100px; margin-left: calc(50% - 300px); margin-top: calc(25% - 50px); background-color: rgba(0,0,0,0.75); border-radius: 10px; "><h1 class="text-center" style="color: #FFF; line-height: 100px;">Processando Pagamento...</h1></div>
</div>