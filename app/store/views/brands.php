<section class="container">
	<h1 class="text-center page-title"><?php echo $brand_name; ?></h1>
	<div class="section-div"></div>
	<div class="row">
		<?php foreach($list as $product_item): ?>
				<?php $this->loadView('prod_item', $product_item); ?>
		<?php endforeach; ?>
	</div>

	<ul class="pagination">
		<?php for($q=1;$q<=$numberOfPages;$q++): ?>
			<li class="btn btn-outline-dark <?php echo ($currentPage==$q)?'active':''; ?>">
				<a style="color: #FFFFFF;" href="<?php echo ROOT_URL; ?>marcas/<?php echo $brand['slug']; ?>?p=<?php echo $q; ?>"><?php echo $q; ?></a>
			</li>
		<?php endfor; ?>
	</ul>
</section>