<?php

class contatoController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [];

        $store = new Store();
        $data = $store->getTemplateData();

        if (isset($_POST['nome'])) {

            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);

            $html = "Nome: ".$nome."\r\n\r\n"."E-mail: ".$email."\r\n\r\n"."Mensagem: \r\n".$mensagem."\r\n";
            $headers = 'From: '. $email ."\r\n";
            $headers .= 'Reply-To: '.$email."\r\n";
            $headers .= 'X-Mailer: PHP'.phpversion();

            mail("atndimento@lustresecia.com.br", "Contato pelo site em ".date('d/m/Y'), $html, $headers);

            $data['mensagem'] = "Obrigado pelo contato, em breve teremos o maior prazer em responder a sua mensagem.";

        }

        $data['searchTerm'] = '';
        $data['category'] = '';

        $data['social_items'] = [
            'url' => 'http://www.lustresecia.com.br/',
            'title' => 'Lustres e Cia',
            'description' => 'Lustres e Cia -  A melhor Loja Online de Iluminação do Brasil. Lustres, pendentes, plafons, arandelas, spots, lampadas e muito mais.',
            'image' => BASE_URL.'assets/img/facebook-perfil.png'
        ];


        $this->loadTemplate('contato', $data);
    }
}
