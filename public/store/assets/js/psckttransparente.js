$(function () {

	$('.efetuarCompra').on('click', function () {

		var id = PagSeguroDirectPayment.getSenderHash();
		var BASE_URL = $('input[name=url]').val();

		var name = $('input[name=name]').val();
		var cpf = $('input[name=cpf]').val();
		var telephone = $('input[name=telephone]').val();
		var email = $('input[name=email]').val();
		var pass = $('input[name=pass]').val();

		var cep = $('input[name=cep]').val();
		var street = $('input[name=street]').val();
		var num = $('input[name=num]').val();
		var complement = $('input[name=complement]').val();
		var district = $('input[name=district]').val();
		var city = $('input[name=city]').val();
		var state = $('select[name=state]').val();
		var pgform = $('select[name=pg_form]').val();

		var cartao_titular = $('input[name=cartao_titular]').val();
		var cartao_aniversario = $('input[name=cartao_aniversario]').val();
		var cartao_cpf = $('input[name=cartao_cpf]').val();
		var cartao_numero = $('input[name=cartao_numero]').val();
		var cvv = $('input[name=cartao_cvv]').val();
		var v_mes = $('select[name=cartao_mes]').val();
		var v_ano = $('select[name=cartao_ano]').val();

		var parc = $('select[name=parc]').val();

		if (cartao_numero != '' && cvv != '' && v_mes != '' && v_ano != '') {
			PagSeguroDirectPayment.createCardToken({
				cardNumber: cartao_numero,
				brand: window.cardBrand,
				cvv: cvv,
				expirationMonth: v_mes,
				expirationYear: v_ano,
				success: function (r) {
					window.cardToken = r.card.token;

					$.ajax({
						url: BASE_URL + '/pagseguro/checkout',
						type: 'POST',
						data: {
							id: id,
							name: name,
							cpf: cpf,
							telephone: telephone,
							email: email,
							pass: pass,
							cep: cep,
							street: street,
							num: num,
							complement: complement,
							district: district,
							city: city,
							state: state,
							cartao_titular: cartao_titular,
							cartao_aniversario: cartao_aniversario,
							cartao_cpf: cartao_cpf,
							cartao_numero: cartao_numero,
							cvv: cvv,
							v_mes: v_mes,
							v_ano: v_ano,
							cartao_token: window.cardToken,
							parc: parc,
							pgform: pgform
						},
						dataType: 'json',
						success: function (r) {
							window.location.href = BASE_URL + "psckttransparente/obrigado"
						},
						error: function (r) {
							alert("Ops, aconteceu algum problema no processamento de seu pagamento, por favor confira todos os dados e clique em Efetuar Compra Novamente!")

							$('#load').css('display', 'none')
						}
					});
				},
				error: function (r) {
					alert("Ops, aconteceu algum problema no processamento do pagamento pelo seu cartão de crédito, por favor confira todos os dados do cartão e tente novamente...")

					$('#load').css('display', 'none')
				}
			});

		} else {

			$.ajax({
				url: BASE_URL + '/pagseguro/checkout',
				type: 'POST',
				data: {
					id: id,
					name: name,
					cpf: cpf,
					telephone: telephone,
					email: email,
					pass: pass,
					cep: cep,
					street: street,
					num: num,
					complement: complement,
					district: district,
					city: city,
					state: state,
					pgform: pgform
				},
				dataType: 'json',
				success: function (json) {
					window.location.href = BASE_URL + "psckttransparente/obrigado";
					window.open(json.link);
				},
				error: function (r) {
					alert("Ops, aconteceu algum problema no processamento de seu pagamento, por favor confira todos os dados e clique em Efetuar Compra Novamente!");
					$('#load').css('display', 'none');
				}
			});
		}

	});

	$('input[name=cartao_numero]').on('keyup', function (e) {
		if ($(this).val().length == 6) {

			PagSeguroDirectPayment.getBrand({
				cardBin: $(this).val(),
				success: function (r) {
					window.cardBrand = r.brand.name;
					var cvvLimit = r.brand.cvvSize;
					$('input[name=cartao_cvv]').attr('maxlength', cvvLimit);

					PagSeguroDirectPayment.getInstallments({

						amount: $('input[name=total_cart]').val(),
						brand: window.cardBrand,
						maxInstallmentNoInterest: 6,
						success: function (r) {

							if (r.error == false) {

								var parc = r.installments[window.cardBrand];

								var html = '';

								for (i = 0; i < 6; i++) {
									var optionValue = parc[i].quantity + ';' + parc[i].installmentAmount + ';';
									if (parc[i].interestFree == true) {
										optionValue += 'true';
									} else {
										optionValue += 'false';
									}

									html += '<option value="' + optionValue + '">' + parc[i].quantity + 'x de R$ ' + parc[i].installmentAmount + '</option>';
								}

								$('select[name=parc]').html(html);

							}

						},
						error: function (r) {
						},
						complete: function (r) { }

					});

				},
				error: function (r) {

				},
				complete: function (r) { }
			});

		}
	});
});