<?php
namespace cncEP;

class Controller
{

	function __construct()
	{
		$this->plugin_path = plugin_dir_path(dirname(__FILE__));
		$this->plugin_url = plugin_dir_url(dirname(__FILE__));

		$this->acf = new ACF();

		add_filter('the_content', [$this, 'insertAfterContent']);
		add_action('wp_enqueue_scripts', [$this, 'registerScripts']);
		add_action( 'wp_footer', [$this, 'add_to_cart_scripts'] );
	}

	public function insertAfterContent($content)
	{
		$view = new \cncEP\View();
		$related_products = $view->render('related_products');
		$content .= $related_products;
		return $content;
	}

	public function registerScripts()
	{
		wp_enqueue_style( 'cncep-style' , $this->plugin_url . 'assets/style.css');
	}

	function add_to_cart_scripts() {
	    if ( is_singular('event') ) : ?>

	<script>
	    jQuery( document ).ready( function( $ ) {
	        $( document ).on( 'change', '.quantity .qty', function() {
	            $( this ).parent( '.quantity' ).next( '.add_to_cart_button' ).data( 'quantity', $( this ).val() );
	        });
	    });
	</script>

	    <?php endif;
	}
}
