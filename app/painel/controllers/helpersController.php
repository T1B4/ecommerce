<?php

class HelpersController extends Controller
{

	public function toReal($value)
	{
		return number_format($value, 2, ',', '.');
	}

	public function ThanksMail($email, $name, $saleCod)
	{

		global $config;;

		$mail = new PHPMailer\PHPMailer\PHPMailer(true);

		try {

			$mail->Charset = 'UTF-8';

			//Server settings
			$mail->isSMTP();
			$mail->Host = $config['host'];
			$mail->SMTPAuth = true;
			$mail->Username = $config['username'];
			$mail->Password = $config['password'];
			$mail->SMTPSecure = 'tls';
			$mail->Port = $config['mail_port'];

			//Recipients
			$mail->setFrom($config['from'], 'Lustres e Cia');
			$mail->addAddress($email, $name);
			// $mail->addReplyTo($config['addReplyTo']);

			//Content
			$mail->isHTML(false);
			$mail->Subject = 'Compra efetuada com sucesso! - Lustres e Cia';
			$mail->Body    = 'Muito bom, sua compra foi processada com sucesso, basta agora aguardar a confirmação da instituição financeira que pode variar de acordo com o meio de pagamento escolhido. <br> Assim que for confirmado o pagamento iremos separar seus produtos e enviar para você, o código de rastreio fica sempre anotado no seu painel de controle pessoal do site, nosso sistema também envia para você um email automaticamente com esse código assim que ele for inserido no sistema. Por hora anote o numero de sua venda caso precise entrar em contato com a gente! <br> Venda Numero : {$saleCod}.';
			$mail->AltBody = 'Muito bom, sua compra foi processada com sucesso, basta agora aguardar a confirmação da instituição financeira que pode variar de acordo com o meio de pagamento escolhido. <br> Assim que for confirmado o pagamento iremos separar seus produtos e enviar para você, o código de rastreio fica sempre anotado no seu painel de controle pessoal do site, nosso sistema também envia para você um email automaticamente com esse código assim que ele for inserido no sistema. Por hora anote o numero de sua venda caso precise entrar em contato com a gente! <br> Venda Numero : {$saleCod}.';

			try {
				$mail->send();
				$mensagem = 'Mensagem Enviada com Sucesso';
			} catch (Exception $e) {
				$mensagem = 'Ocorreu um problema com o envio do email :' . $e->getMessage();
			}

			return $mensagem;

		} catch (Exception $e) {

			$mensagem = 'Mensagem não enviada: ' . $mail->ErrorInfo;
			return $mensagem;

		}

	}

	public function ShippingMail($email, $name, $shipping_code)
	{

		global $config;;

		$mail = new PHPMailer\PHPMailer\PHPMailer(true);

		try {

			$mail->Charset = 'UTF-8';

			//Server settings
			$mail->isSMTP();
			$mail->Host = $config['host'];
			$mail->SMTPAuth = true;
			$mail->Username = $config['username'];
			$mail->Password = $config['password'];
			$mail->SMTPSecure = 'tls';
			$mail->Port = $config['mail_port'];

			//Recipients
			$mail->setFrom($config['from'], 'Lustres e Cia');
			$mail->addAddress($email, $name);
			// $mail->addReplyTo($config['addReplyTo']);

			//Content
			$mail->isHTML(false);
			$mail->Subject = 'Seus Produtos Foram Enviados! - Lustres e Cia';
			$mail->Body    = '<h1>Seu Pedido acabou de ser Enviado!</h1><br> Olá {$name}, como vai tudo bem? <br> Estamos enviando essa mensagem para avisar que seu pedido acabou de ser enviado pela nossa equipe, agora é só aguardar o prazo de entrega que foi informado no momento da compra, disponibilizamos também o código de rastreio caso queira saber o andamento da sua entrega, basta acessar o site dos correios ou da transportadora e você poderá acompanhar passo a passo o caminho dos seus produtos. <br> O código é {$shipping_code}, mas não se preocupe caso você perca esse email, o código fica também disponível no seu painel de controle na nossa loja. <br> Mais uma vez agradecemos a sua visita e sua compra e esperamos que fique muito satisfeito com seus produtos!';
			$mail->AltBody = '<h1>Seu Pedido acabou de ser Enviado!</h1><br> Olá {$name}, como vai tudo bem? <br> Estamos enviando essa mensagem para avisar que seu pedido acabou de ser enviado pela nossa equipe, agora é só aguardar o prazo de entrega que foi informado no momento da compra, disponibilizamos também o código de rastreio caso queira saber o andamento da sua entrega, basta acessar o site dos correios ou da transportadora e você poderá acompanhar passo a passo o caminho dos seus produtos. <br> O código é {$shipping_code}, mas não se preocupe caso você perca esse email, o código fica também disponível no seu painel de controle na nossa loja. <br> Mais uma vez agradecemos a sua visita e sua compra e esperamos que fique muito satisfeito com seus produtos!';

			try {
				$mail->send();
				$mensagem = 'Mensagem Enviada com Sucesso';
			} catch (Exception $e) {
				$mensagem = 'Ocorreu um problema com o envio do email :' . $e->getMessage();
			}

			return $mensagem;

		} catch (Exception $e) {

			$mensagem = 'Mensagem não enviada: ' . $mail->ErrorInfo;
			return $mensagem;

		}

	}

}
