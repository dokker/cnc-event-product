<?php
namespace cncEP;

class Controller
{

	function __construct()
	{
		$this->acf = new ACF();

		add_filter('the_content', [$this, 'insertAfterContent']);
	}

	public function insertAfterContent($content)
	{
		$view = new \cncEP\View();
		$related_products = $view->render('related_products');
		$content .= $related_products;
		return $content;
	}
}
