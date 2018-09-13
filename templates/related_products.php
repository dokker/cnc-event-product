<?php
/**
 * Template for related products
 *
 * Template with quantity and ajax.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.
?>


<?php $posts = get_field('related_product'); ?>

<?php if($posts): ?>
	<div class="woocommerce related-products">
	<?php foreach ($posts as $post): ?>
		<div class="product">


	<?php
		$pf = new \WC_Product_Factory();
		$product = $pf->get_product($post->ID);
	?>


		<?php if ( ! $product->is_in_stock() ) : ?>

		    <a href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product->id ) ); ?>" class="button"><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Read More', 'woocommerce' ) ); ?></a>

		<?php else : // in stock ?>
			<p class="product-title"><?php echo $product->get_name(); ?> - <?php echo wc_price($product->get_price()); ?></p>

		    <?php
		        $link = array(
		            'url'   => '',
		            'label' => '',
		            'class' => ''
		        );

		        switch ( $product->product_type ) {
		            case "variable" :
		                $link['url']    = apply_filters( 'variable_add_to_cart_url', get_permalink( $product->id ) );
		                $link['label']  = apply_filters( 'variable_add_to_cart_text', __( 'Select options', 'woocommerce' ) );
		            break;
		            case "grouped" :
		                $link['url']    = apply_filters( 'grouped_add_to_cart_url', get_permalink( $product->id ) );
		                $link['label']  = apply_filters( 'grouped_add_to_cart_text', __( 'View options', 'woocommerce' ) );
		            break;
		            case "external" :
		                $link['url']    = apply_filters( 'external_add_to_cart_url', get_permalink( $product->id ) );
		                $link['label']  = apply_filters( 'external_add_to_cart_text', __( 'Read More', 'woocommerce' ) );
		            break;
		            default :
		                if ( $product->is_purchasable() ) {
		                    $link['url']    = apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
		                    $link['label']  = apply_filters( 'add_to_cart_text', __( 'Add to cart', 'woocommerce' ) );
		                    $link['class']  = apply_filters( 'add_to_cart_class', 'add_to_cart_button' );
		                } else {
		                    $link['url']    = apply_filters( 'not_purchasable_url', get_permalink( $product->id ) );
		                    $link['label']  = apply_filters( 'not_purchasable_text', __( 'Read More', 'woocommerce' ) );
		                }
		            break;
		        }

		        // If there is a simple product.
		        if ( $product->product_type == 'simple' ) {
		            ?>
		            <form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype="multipart/form-data">
		                <?php
		                    // Displays the quantity box.
		                    woocommerce_quantity_input();

		                    // Display the submit button.
		                    echo sprintf( '<button type="submit" data-product_id="%s" data-product_sku="%s" data-quantity="1" class="%s button mk-button mk-button--dimension-outline skin-dark ajax_add_to_cart">%s</button>', esc_attr( $product->id ), esc_attr( $product->get_sku() ), esc_attr( $link['class'] ), esc_html( $link['label'] ) );
		                ?>
		            </form>
		            <?php
		        } else {
		          echo apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s button product_type_%s">%s</a>', esc_url( $link['url'] ), esc_attr( $product->id ), esc_attr( $product->get_sku() ), esc_attr( $link['class'] ), esc_attr( $product->product_type ), esc_html( $link['label'] ) ), $product, $link );
		        }

		    ?>

		<?php endif; ?>

		</div>
	<?php endforeach; ?>
	</div>
<?php endif; // if($products) ?>
