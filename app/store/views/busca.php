<section class="container">
	<h1 class="page-title">Você está procurando por: "<?php echo $searchTerm; ?>"</h1>
	<div class="row">
		<?php foreach($list as $product_item): ?>
			<?php $this->loadView('prod_item', $product_item); ?>
		<?php endforeach; ?>

		<br>

		<div class="container">
			<ul class="pagination">
				<?php for($q=1;$q<=$numberOfPages;$q++): ?>
					<li class="btn btn-dark text-white ml-1 <?php echo ($currentPage==$q)?'active':''; ?>"><a class="text-white" href="<?php echo ROOT_URL; ?>?<?php
					$pag_array = $_GET;
					$pag_array['p'] = $q;
					echo http_build_query($pag_array);
					?>"><?php echo $q; ?></a></li>
				<?php endfor; ?>
			</ul>
		</div>
	</div>
</section>