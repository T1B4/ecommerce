<?php ($product_info['id'] < 10) ? $cc = 0 : $cc = '';?>

<!-- JSON SCHEMA.ORG -->
<script type="application/ld+json">
  {
    "@context": "http://schema.org/",
    "@type": "Product",
    "name": "<?php echo $product_info['name']; ?>",
    "image": "<?php echo BASE_URL; ?>media/products/<?php echo $cc . $product_info['id']; ?>/<?php echo $product_images[0]['url']; ?>",
    "description": "<?php echo $product_info['description']; ?>",
    "brand": "<?php echo $product_info['brand_name']; ?>",
    "offers": {
      "@type": "Offer",
      "priceCurrency": "BRL",
      "price": "<?php echo $product_info['price']; ?>",
      "itemCondition": "http://schema.org/NewCondition"
    }
  }
</script>
<!-- JSON SCHEMA.ORG -->

<br>
<section class="container">
  <h1 class="hidden"><?php echo $product_info['name']; ?></h1>
  <div>
    <div class="row text-center">
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <img class="img-fluid"
          src="<?php echo BASE_URL; ?>media/products/<?php echo $cc . $product_info['id']; ?>/<?php echo $product_images[0]['url']; ?>" />
        <br>
        <hr>
        <!-- <h2>Imagens</h2> -->
        <div class="row item-thumbs">
          <?php foreach ($product_images as $img): ?>
          <div class=" col-4 col-sm-4 col-md-3 col-lg-3 col-xl-2">
            <a href="<?php echo BASE_URL; ?>media/products/<?php echo $cc . $product_info['id']; ?>/<?php echo $img['url']; ?>"
              data-toggle="lightbox" data-gallery="img-gallery">
              <img class="img-fluid"
                src="<?php echo BASE_URL; ?>media/products/<?php echo $cc . $product_info['id']; ?>/thumbs/<?php echo $img['url']; ?>"
                alt="<?php echo $product_info['name']; ?>" />
            </a>
          </div>
          <?php endforeach;?>
        </div>
      </div>

      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div>
          <!-- SEÇÃO PRINCIPAL DO PRODUTO -->
          <h1><?php echo $product_info['name']; ?></h1>
          <div class="section-div"></div>
          <div><?php echo $product_info['brand_name']; ?></div>
          <div>Cód: <?php echo $product_info['code']; ?></div>
          <div>
            <?php if ($product_info['rating'] != '0'): ?>
            <?php for ($q = 0; $q < intval($product_info['rating']); $q++): ?>
            <img src="<?php echo BASE_URL; ?>assets/img/star.png" style="width: 15px; border: 0;">
            <?php endfor;?>
            <?php endif;?>
          </div>
          <span><?php echo $product_info['description']; ?></span>
          <!-- SEÇÃO PRINCIPAL DO PRODUTO -->

          <!-- SEÇÃO DO PREÇO -->
          <div class="section-div"></div>
          <?php if ($product_info['price_from'] > 0): ?>
          de: <span>R$ <?php echo number_format($product_info['price_from'], 2, ',', '.'); ?></span>
          por:
          <?php endif?>

          <br>

          <div>
            <span class="item-price"><b>R$ <?php echo number_format($product_info['price'], 2); ?></b><br>à vista no
              boleto!</span>
          </div>

          <div class="">
            ou<br> R$ <?php echo number_format($product_info['price_from'], 2, ',', '.'); ?> em até 6x s/ juros de R$
            <br> <?php echo number_format($product_info['price_from'] / 6, 2, ',', '.'); ?> no cartão de crédito!
          </div>
          <br>

          <form method="POST" class="addtocartform form" action="<?php echo ROOT_URL; ?>cart/add">
            <input type="hidden" name="id_product" value="<?php echo $product_info['id']; ?>" />
            <input type="hidden" name="qt_product" value="1" />
            <div class="mb-3">
              <button class="btn btn-qtde btn-outline-primary" data-action="decrease">-</button>
              <input class="addtocart_qt text-center" type="text" name="qt" value="1" disabled>
              <button class="btn btn-qtde btn-outline-primary" data-action="increase">+</button>
            </div>
            <input class="btn btn-lg btn-warning" type="submit" value="COMPRAR"
              style="font-size: 22px; color: #FFFFFF;" />
          </form>
          <br>
          <!-- SEÇÃO DO PREÇO -->

          <!-- SEÇÃO DE DISPONIBILIDADE DO PRODUTO -->
          <div class="section-div"></div>
          <div style="margin-bottom: 20px;">
            <h4>Disponibilidade :
              <?php ($product_info['stock'] > 0) ? $disp = 'Imediata' : $disp = $product_info['shipping_days'] . ' dias úteis + prazo de entrega.';?>
              <span><?php echo $disp; ?></span></h4>
          </div>

          <!-- SEÇÃO DE DISPONIBILIDADE DO PRODUTO -->

        </div>

      </div>
    </div>

    <div class="row bg-light p-3 m-lg-5 border">
      <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">


        <!-- SEÇÃO CALCULO DO FRETE -->
        <?php ($product_info['stock'] > 0) ? $disp = 0 : $disp = $product_info['shipping_days'];?>
        <?php if ($product_info['frete'] == 1): ?>
        <div>
          <h3>Produto com Frete GRÁTIS!!!</h3>
        </div>

        <?php elseif (!empty($frete)): ?>

        <div class="text-center frete-title">Envio pelos Correios</div>

        <?php if (isset($frete)): ?>

        <?php foreach ($frete as $option): ?>
        <div class="text-center"><?php echo $option['type']; ?></div>
        <div class="text-center">R$ <?php echo $option['price']; ?></div>
        <div class="text-center">Prazo de entrega : aprox. <?php echo $option['date'] + $disp; ?> dias úteis.</div>
        <br>

        <?php endforeach;?>

        <?php endif?>

        <?php else: ?>
        <div class="frete text-center">
          <h4 class="text-center">Simule o frete</h4>
          <form method="POST" class="form">
            <div class="text-center form-group">
              <div>Digite o CEP de destino.</div>
              <input type="hidden" name="qt_product" value="1" />
              <input class="input-cart" type="text" name="cep" class="form-control" maxlength="9"><br><br>
              <input type="submit" value="Calcular" class="btn btn-warning" style="color: #FFFFFF;">
            </div>
          </form>
        </div>
        <?php endif?>


        <!-- SEÇÃO CALCULO DO FRETE -->

      </div>
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <!-- SEÇÃO DE ESPECIFICAÇÕES TECNICAS -->
        <div class="prod-section" style="margin-bottom: 20px;">
          <?php if (isset($product_options) && !empty($product_options)): ?>
          <h3>Especificações Técnicas</h3>
          <?php foreach ($product_options as $po): ?>
          <span><b><?php echo $po['name']; ?></b> : <?php echo $po['value']; ?></span><br />
          <?php endforeach;?>
          <?php endif?>
        </div>

        <!-- SEÇÃO DE ESPECIFICAÇÕES TECNICAS -->
      </div>
    </div>
  </div>
</section>

<?php if (isset($relacionados) && !empty($relacionados)): ?>
<section class="container home-section mt-4">
  <h1 class="text-center section-title">Quem viu esse produto também viu</h1>
  <div class="section-div"></div>
  <div class="row">
    <?php foreach ($relacionados as $relacionado): ?>
    <?php $this->loadView('prod_item', $relacionado);?>
    <?php endforeach?>
  </div>

</section>
<?php endif?>