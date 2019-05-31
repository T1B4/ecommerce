<section class="container">
	<h1 class="text-center page-title"><?php echo $category_name; ?></h1>
	<div class="section-div"></div>
	<div class="row">
		<?php foreach($list as $product_item): ?>
				<?php $this->loadView('prod_item', $product_item); ?>
		<?php endforeach; ?>
	</div>

	<ul class="pagination">
		<?php for($q=1;$q<=$numberOfPages;$q++): ?>
			<li class="btn btn-dark text-white ml-1 <?php echo ($currentPage==$q)?'active':''; ?>">
				<a class="text-white" href="<?php echo ROOT_URL; ?>categorias/<?php echo $slug; ?>?p=<?php echo $q; ?>"><?php echo $q; ?></a>
			</li>
		<?php endfor; ?>
	</ul>
</section>