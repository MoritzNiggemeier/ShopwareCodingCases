<?php declare(strict_types=1);

namespace CodingCase\Storefront\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Shopware\Storefront\Controller\StorefrontController;
use CodingCase\Core\Content\Faq\SalesChannel\FaqRoute;

#[Route(defaults: ['_routeScope' => ['storefront']])]
class FaqSetController extends StorefrontController{

	private FaqRoute $route;

	public function __construct( FaqRoute $route )
	{
		$this->route = $route;
	}

	#[Route(path: '/createFaq', name: 'frontend.faq.create', methods: ['POST'], defaults: ['XmlHttpRequest' => true, 'auth_required' => true])]
	public function createFaq( Request $request ): Response
	{
		$question = $request->request->get('content');
		$productId = $request->request->get('productId');
		
		$success = $this->route->setFaq( $question, $productId );
		
		return $this->renderStorefront('@CodingCase/storefront/page/product-detail/faq/faq-form.html.twig', [
			'FaqFormSuccess' => $success,
			'productId' => $productId
		]);
	}
}