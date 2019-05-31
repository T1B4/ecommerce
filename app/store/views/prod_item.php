<?php ($id < 10)? $cc = 0: $cc = ''; ?>

<article class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
	<div class="card prod-item-frame">
		<a href="<?php echo ROOT_URL; ?><?= $category_slug; ?>/<?= $slug; ?>">
			<div class="">
				<div class="product_tags">
					<?php if($sale == '1'): ?>
						<div class="product_tag product_tag_red text-center"><?php echo 'Preço Especial' ?></div>
					<?php endif; ?>
					<?php if($bestseller == '1'): ?>
						<div class="product_tag product_tag_green text-center"><?php echo 'Mais Vendido' ?></div>
					<?php endif; ?>
					<?php if($new_product == '1'): ?>
						<div class="product_tag product_tag_blue text-center"><?php echo 'Produto Novo' ?></div>
					<?php endif; ?>
					<?php if($frete == '1'): ?>
						<div class="product_tag product_tag_purple text-center"><?php echo 'FRETE GRÁTIS' ?></div>
					<?php endif; ?>
					<?php if($id_brand == 3): ?>
					<div style="top: 3px; position: relative;">
						<img height="80" src="<?php echo BASE_URL; ?>assets/img/feito-no-brasil.png" alt="Produto Feito no Brasil">
						</div>
					<?php endif; ?>
				</div>
				<div>
				<img class="card-img-top" src="<?php echo BASE_URL; ?>media/products/<?php echo $cc.$id; ?>/thumbs/<?php echo $images[0]['url']; ?>" alt="<?php echo $name; ?>">
				</div>
			</div>
			<div class="card-body">
			<div style="min-height: 60px;">
				<h1 class="text-center prod-item-title card-title"><?php echo $name; ?></h1>
				</div>
				<div class="text-center card-text">
					<span>
						<b style="font-size: 18px; color: #26A69A;">R$ <?php echo number_format($price, 2, ',', '.'); ?></b><br> à vista c/ desconto<br>ou
						até 6x de <span style="color: #f44336; font-weight: bold;">R$ <?php echo number_format($price_from / 6, 2, ',', '.'); ?></span>
					</span>
				</div>
			</div>
		</a>
		<div class="text-center">
			<form method="POST" class="addtocartform" action="<?php echo ROOT_URL; ?>cart/add">
				<input type="hidden" name="id_product" value="<?php echo $id; ?>"/>
				<input type="hidden" name="qt_product" value="1"/>
				<input class="btn prod-item-btn btn-warning" type="submit" value="COMPRAR" style="z-index: 99; color: #FFFFFF;">
			</form>
		</div>
	</div>
</article>

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "ItemList",
  "url": "<?php echo BASE_URL; ?><?= $category_slug; ?>/<?= $slug; ?>",
  "numberOfItems": "<?php echo $stock; ?>",
  "itemListElement": [{
      "@type": "Unordered",
      "image": "<?php echo BASE_URL; ?>media/products/<?php echo $cc.$id; ?>/<?php echo $images[0]['url']; ?>",
      "url": "<?php echo BASE_URL; ?><?= $category_slug; ?>/<?= $slug; ?>",
      "name": "<?php echo $brand_name; ?>"
    },{
      "@type": "Product",
      "name": "<?php echo $name; ?>"
    }
  ],
    "offers": {
      "@type": "Offer",
      "price": "<?php echo $price; ?>"
    }
}
</script>