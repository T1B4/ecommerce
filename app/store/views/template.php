<?php
if (isset($viewData['social_items'])) {
	extract($viewData['social_items']);
} else {
	$url = 'http://www.lustresecia.com.br';
	$title = 'Lustre e Cia';
	$description = 'Lustres e Cia -  A melhor Loja Online de Iluminação do Brasil. Lustres, pendentes, plafons, arandelas, spots, lampadas e muito mais.';
	$image = BASE_URL . 'assets/img/logo.jpg';
}

if (isset($viewData['page_title']) && !empty($viewData['page_title'])) {
	$page_title = $viewData['page_title'] . ' | Lustres e Cia.';
	$og_title = $viewData['page_title'] . ' | Lustres e Cia.';
} else {
	$page_title = "Lustres e Cia";
	$og_title = 'Lustres e Cia - A melhor loja de iluminação do Brasil.';
}
?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Lustres e Cia - A melhor loja de iluminação do Brasil.">

  <meta property="og:locale" content="pt_BR">
  <meta property="og:url" content="<?php echo $url; ?>">
  <meta property="og:title" content="<?php echo $title; ?>">
  <meta property="og:site_name" content="Lustres e Cia - A melhor loja de iluminação do Brasil">
  <meta property="og:description" content="<?php echo $description; ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="<?php echo $image; ?>">

  <title><?= $page_title; ?></title>
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css"
    integrity="sha256-HAaDW5o2+LelybUhfuk0Zh2Vdk8Y2W2UeKmbaXhalfA=" crossorigin="anonymous" />
  <link rel="icon" href="<?php echo BASE_URL; ?>assets/img/logo.jpg">

  <script src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116478920-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-116478920-1');
  </script>

  <!-- Global site tag (gtag.js) - AdWords: 810502635 -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=AW-810502635"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'AW-810502635');
  </script>

  <script>
    gtag('event', 'page_view', {
      'send_to': 'AW-810502635',
      'user_id': 'replace with value'
    });
  </script>


  <!-- Facebook Pixel Code -->
  <script>
    ! function (f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function () {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '471912293211143');
    fbq('track', 'PageView');
  </script>
  <noscript>
    <img height="1" width="1" src="https://www.facebook.com/tr?id=471912293211143&ev=PageView
			&noscript=1" />
  </noscript>
  <!-- End Facebook Pixel Code -->

</head>

<body>

  <div class="hidden">
    <h1><?php echo $page_title; ?></h1>
  </div>
  <section class="top-bar d-none d-lg-block">
    <div class="container">
      <ul class="nav">
        <a href="https://api.whatsapp.com/send?l=pt_BR&phone=+5514996032913">
          <li class="nav-item">WhatsApp (14) 99603 - 2913</li>
        </a>
        <a href="<?php echo ROOT_URL; ?>institucional/sobrenos">
          <li class="nav-item">Sobre Nós</li>
        </a>
        <a href="<?php echo ROOT_URL; ?>contato">
          <li class="nav-item">Fale Conosco</li>
        </a>
      </ul>
    </div>
  </section>

  <header>
    <div class="container">
      <div class="row header align-items-center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-3 justify-content-center text-center">
          <a href="<?php echo ROOT_URL; ?>"><img class="logo-header img-fluid" style="margin-top: 5px;"
              src="<?php echo BASE_URL; ?>assets/img/logo-lustresecia.jpg" alt="Logo Lustres e Cia"></a>
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-6 justify-content-center d-none d-lg-block">
          <form action="<?php echo ROOT_URL; ?>busca">
            <div class="form-group">
              <input class="form-control" type="text" name="s" placeholder="O que você procura?">
            </div>
          </form>
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3 d-none d-lg-block">
          <div class="row justify-content-center align-items-center">
            <a href="<?php echo ROOT_URL; ?>cart">
              <div class="col-6">
                <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                <span
                  class="badge badge-pill badge-success header-cart-badger"><?php echo array_sum($_SESSION['cart']); ?></span>
                <?php else: ?>
                <span class="badge badge-pill badge-secondary header-cart-badger">0</span>
                <?php endif ?>
                <img src="<?php echo BASE_URL; ?>assets/img/shopping-cart.png" alt="Carrinho de Compras">
              </div>
            </a>

            <a href="<?php echo ROOT_URL; ?>user/login">
              <div class="col-6">
                <img src="<?php echo BASE_URL; ?>assets/img/users.png" alt="Minha Conta">
                <div>ENTRAR</div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- MENU DESKTOP -->
  <nav class="nav-site sticky-top navbar-dark  d-none d-lg-block">
    <div class="container">
      <ul class="nav justify-content-center">
        <?php foreach ($viewData['categories'] as $cat): ?>
        <li class="nav-item main_dropdown">
          <a href="<?php echo ROOT_URL . 'categorias/' . $cat['slug']; ?>"><?php echo $cat['name']; ?></a>

          <?php
							if (count($cat['subs']) > 0) {
								echo "<ul class='nav main_dropdown_content'>";
								$this->loadView('search_subcategory', array(
									'subs' => $cat['subs'],
									'level' => 1,
									'category' => $viewData['category']
								));
								echo "</ul>";
							}
							?>

        </li>
        <?php endforeach ?>
      </ul>
    </div>
  </nav>
  <!-- MENU DESKTOP -->

  <!-- MENU MOBILE BOOTSTRAP -->
  <nav class="navbar navbar-expand-lg navbar-light d-lg-none d-block">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <div class="section-navbar"></div>
        <li>
          <a href="<?php echo ROOT_URL; ?>cart">
            <img src="<?php echo BASE_URL; ?>assets/img/shopping-cart.png" alt="Carrinho de Compras">
          </a>

          <a href="<?php echo ROOT_URL; ?>user/login">
            <img src="<?php echo BASE_URL; ?>assets/img/users.png" alt="Minha Conta">
          </a>
        </li>
        <div class="section-navbar"></div>
        <li class="text-center">
          <form action="<?php echo ROOT_URL; ?>busca">
            <div class="form-group">
              <input class="form-control" type="text" name="s" placeholder="O que você procura?">
            </div>
          </form>
        </li>
        <li class="text-center"><a href="<?php echo ROOT_URL; ?>"><b>Home</b></a></li>
        <div class="section-navbar"></div>
        <?php foreach ($viewData['categories'] as $cat): ?>
        <li>
          <a href="<?php echo ROOT_URL . 'categorias/' . $cat['slug']; ?>"><b><?php echo $cat['name']; ?></b></a>

          <?php
							if (count($cat['subs']) > 0) {
								echo "<ul class='list-unstyled'>";
								$this->loadView('search_subcategory_mobile', array(
									'subs' => $cat['subs'],
									'level' => 1,
									'category' => $viewData['category']
								));
								echo "</ul>";
							}
							?>

        </li>
        <div class="section-navbar"></div>
        <?php endforeach ?>
      </ul>
    </div>
  </nav>
  <!-- MENU MOBILE BOOTSTRAP -->

  <section style="background-color: #5D5192;" class="d-none d-lg-block">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 p-1 text-center text-white">
          <div class="row">
            <div class="col-3">
              <img class="img-fluid" src="<?php echo BASE_URL; ?>assets/img/truck.png" alt="Frete Grátis">
            </div>
            <div class="col-9">Enviamos seu pedido para todo o Brasil!</div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 p-1 text-center text-white">
          <div class="row">
            <div class="col-3">
              <img class="img-fluid" src="<?php echo BASE_URL; ?>assets/img/percentage.png"
                alt="11% de desconto à Vista">
            </div>
            <div class="col-9">Desconto de 10% nas compras à vista no Boleto</div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 p-1 text-center text-white">
          <div class="row">
            <div class="col-3">
              <img class="img-fluid" src="<?php echo BASE_URL; ?>assets/img/price-tag.png"
                alt="6x sem juros no cartão de crédito">
            </div>
            <div class="col-9">Parcele em até 6x sem juros no cartão</div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 p-1 text-center text-white">
          <div class="row">
            <div class="col-3">
              <img class="img-fluid" src="<?php echo BASE_URL; ?>assets/img/locked-padlock.png" alt="Site Seguro">
            </div>
            <div class="col-9">Site 100% seguro, empresa há 10 anos no mercado!</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div>
    <?php $this->loadViewInTemplate($viewName, $viewData); ?>
  </div>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3">
          <h1 class="text-center">Institucional</h1>
          <ul class="text-center">
            <li><a href="<?php echo ROOT_URL; ?>institucional/sobrenos">Sobre Nós</a></li>
            <li><a href="<?php echo ROOT_URL; ?>institucional/ondeestamos">Onde Estamos</a></li>
            <li><a href="<?php echo ROOT_URL; ?>contato">Fale Conosco</a></li>
          </ul>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3">
          <h1 class="text-center">Dúvidas Frequentes</h1>
          <ul class="text-center">
            <li><a href="<?php echo ROOT_URL; ?>ajuda/comocomprar">Como Comprar</a></li>
            <li><a href="<?php echo ROOT_URL; ?>ajuda/pagamentos">Formas de Pagamento</a></li>
            <li><a href="<?php echo ROOT_URL; ?>ajuda/entregas">Entregas</a></li>
            <!-- <li><a href="#">Dúvidas Frequentes</a></li> -->
            <li><a href="<?php echo ROOT_URL; ?>ajuda/trocas">Trocas e Devoluções</a></li>
            <li><a href="<?php echo ROOT_URL; ?>ajuda/garantia">Politica de Garantia</a></li>
          </ul>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3">
          <h1 class="text-center">Central de Atendimento</h1>
          <ul class="text-center">
            <li><a href="<?php echo ROOT_URL; ?>user/controlPanel">Minha Conta</a></li>
            <li><a href="<?php echo ROOT_URL; ?>user/myPurchases">Meus Pedidos</a></li>
            <li>Horário de Atendimento:</li>
            <li><i>Seg à Sex 08:00 às 18:00 hrs</i></li>
            <li><i>Sábados 08:00 às 12:00 hrs</i></li>
            <li>sac@lustresecia.com.br</li>
          </ul>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3">
          <h1 class="text-center">Sociais</h1>
          <div class="row">
            <div class="col-4 text-center"><a href="https://www.facebook.com/lustresecia"><img
                  src="<?php echo BASE_URL; ?>assets/img/facebook.png" alt="Facebook Lustres e Cia"></a></div>
            <div class="col-4 text-center"><a href="#"><img src="<?php echo BASE_URL; ?>assets/img/instagram.png"
                  alt="Instagram Lustres e Cia"></a></div>
            <div class="col-4 text-center"><a href="https://api.whatsapp.com/send?l=pt_BR&phone=+5514996032913"><img
                  src="<?php echo BASE_URL; ?>assets/img/whatsapp.png" alt="WhatsApp Lustres e Cia"></a></div>
          </div>
          <br>
          <h1 class="text-center">Segurança</h1>
          <div class="row">
            <div class="col-6 text-center"><img src="<?php echo BASE_URL; ?>assets/img/site-seguro.png"
                alt="Segurança Lustres e Cia"></div>
            <div class="col-6 text-center"><img src="<?php echo BASE_URL; ?>assets/img/google-seguro.png"
                alt="Google Security Lustres e Cia"></div>
          </div>
        </div>
      </div>
      <div class="section-div"></div>
      <div class="row text-center">
        <div class="col-12">
          <div>Lustres e Cia - Lustres, luminárias e iluminação.</div>
          <div>Rua Marechal Bittencourt, 201 - Centro</div>
          <div>Jaú - SP</div>
          <div>CNPJ - 09.313.996/0001-60</div>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"
    integrity="sha256-Y1rRlwTzT5K5hhCBfAFWABD4cU13QGuRN6P5apfWzVs=" crossorigin="anonymous"></script>
  <script src="<?php echo BASE_URL; ?>assets/js/owl.carousel.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/js/jquery.mask.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>

</body>

</html>