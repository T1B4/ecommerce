<!-- INICIO DO CARROSSEL -->
<?php if ( !empty($destaques)): ?>
<div id="carouselControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" style="background-color: #000;">
        <?php $ref = 'active'; ?>
        <?php foreach ($destaques as $destaque): ?>
            <?php ($destaque['id'] < 10) ? $cc = '0' : $cc = ''; ?>
            <div class="carousel-item <?php echo $ref; ?>">
                <div class="container"> 
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 justify-content-center div-img-carroussel" style="padding: 10px;">
                            <a href="<?php echo ROOT_URL; ?><?= $destaque['category_slug']; ?>/<?= $destaque['slug']; ?>">
                                <img class="img-fluid img-carroussel" src="<?php echo BASE_URL; ?>media/products/<?php echo $cc . $destaque['id']; ?>/<?php echo $destaque['images'][0]['url']; ?>" alt="<?php echo $destaque['name']; ?>">
                            </a>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 justify-content-center">
                            <a href="<?php echo ROOT_URL; ?><?= $destaque['category_slug']; ?>/<?= $destaque['slug']; ?>">
                                <h1 class="text-center carousel-title"><?php echo $destaque['name']; ?></h1>
                                <div class="carousel-description text-center"><?php echo mb_strimwidth($destaque['description'], 0, 200, '...') ; ?></div>
                                <div class="carousel-price text-center">R$ <?php echo number_format($destaque['price'], 2, ',', '.'); ?><br> à vista com desconto.</div>
                            </a>
                            <br>
                            <div class="text-center">
                                <form style="padding-bottom: 15px;" method="POST" class="addtocartform" action="<?php echo ROOT_URL; ?>cart/add">
                                    <input type="hidden" name="id_product" value="<?php echo $destaque['id']; ?>"/>
                                    <input type="hidden" name="qt_product" value="1"/>
                                    <input class="btn btn-lg btn-outline-warning" type="submit" value="COMPRAR" style="z-index: 99;">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $ref = ''; ?>
        <?php endforeach ?>
    </div>
    <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Posterior</span>
    </a>
</div>
<?php endif; ?>
<!-- FINAL DO CARROUSSEL -->

<?php if (!empty($destaques)) :?>
<section class="container home-section">
    <h1 class="text-center section-title">Destaques</h1>
    <div class="section-div"></div>
    <div class="row">
        <?php foreach ($destaques as $destaque): ?>
            <?php $this->loadView('prod_item', $destaque); ?>
        <?php endforeach ?>
    </div>
</section>
<?php endif; ?>


<?php if (!empty($maisvendidos)) :?>
<section class="container home-section">
    <h1 class="text-center section-title">Mais Vendidos</h1>
    <div class="section-div"></div>
    <div class="row">
        <?php foreach ($maisvendidos as $maisvendido): ?>
            <?php $this->loadView('prod_item', $maisvendido); ?>
        <?php endforeach ?>
    </div>
</section>
<?php endif; ?>


<?php if (!empty($lancamentos)): ?>
<section class="container home-section">
    <h1 class="text-center section-title">Lançamentos</h1>
    <div class="section-div"></div>
    <div class="row">
        <?php foreach ($lancamentos as $lancamento): ?>
            <?php $this->loadView('prod_item', $lancamento); ?>
        <?php endforeach ?>
    </div>

</section>
<?php endif ;?>


<!-- <section class="container home-section">
    <h1 class="text-center section-title">Navegar Por Marcas</h1>
    <div class="section-div"></div>
    <div class="row align-items-center text-center">
        <?php foreach ($brands as $brand): ?>
            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="bg-dark brands-frame">
                    <a href="<?php echo ROOT_URL . 'marcas/' . $brand['slug']; ?>">
                        <img class="img-fluid" src="<?php echo BASE_URL; ?>media/brands/<?php echo $brand['img']; ?>" alt="<?php echo $brand['name']; ?>">
                    </a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</section> -->

<!-- <section class="container home-section">
    <h1 class="text-center section-title">Navegar Por Categorias</h1>
    <div class="section-div"></div>
    <div class="row justify-content-center align-items-center">
        <div class="owl-carousel owl-theme">
            <?php foreach ($categories as $category): ?>
                <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-2 item">
                    <a href="<?php echo ROOT_URL . 'categorias/' . $category['slug']; ?>">
                        <div class="category-frame text-center">
                            <div>
                                <img class="img-fluid mx-auto d-block" src="<?php echo BASE_URL; ?>media/categories/<?php echo $category['img']; ?>" alt="<?php echo $category['name']; ?>">
                            </div>
                            <div class="category-frame-name text-center">
                                <h6><?php echo $category['name']; ?></h6>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section> -->

<section class="container home-section">
    <h1 class="text-center section-title">Preço Especial</h1>
    <div class="section-div"></div>
    <div class="row">
        <?php foreach ($promocao as $promo): ?>
            <?php $this->loadView('prod_item', $promo); ?>
        <?php endforeach ?>
    </div>

</section>