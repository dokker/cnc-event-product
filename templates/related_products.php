<?php $related_product = get_field('related_product');
if( !empty($related_product) ): ?>
	<div class="related-product-container">
		<a href="<?php echo get_permalink($related_product); ?>" class="single_add_to_cart_button shop-skin-btn shop-flat-btn alt related-product-button"><i class="fa fa-cart-plus"></i><?php echo get_the_title($related_product); ?></a>
	</div>
<?php endif; ?>
