<?php

class Helpers
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
			$mail->Body    = 'Corpo do email';
			$mail->AltBody = 'Texto alternativo para substituir o texto padrão só que em formato texto';

			$mail->send();
			$mensagem = 'Mensagem Enviada com Sucesso';
			return $mensagem;

		} catch (Exception $e) {

			$mensagem = 'Mensagem não enviada: ' . $mail->ErrorInfo;
			return $mensagem;

		}

	}

}
