<?php declare(strict_types=1);

namespace CodingCase\Storefront\Controller;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\MultiFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\NotFilter;
use Shopware\Storefront\Page\Product\ProductPageLoadedEvent;
use CodingCase\Core\Content\Faq\SalesChannel\FaqRoute;

class FaqGetController implements EventSubscriberInterface
{
	private FaqRoute $route;

	public function __construct( FaqRoute $route )
	{
		$this->route = $route;
	}

	public static function getSubscribedEvents(): array
	{
		return [ ProductPageLoadedEvent::class => 'getFaq' ];
	}

	public function getFaq(ProductPageLoadedEvent $event): void
	{
		$id = $event->getPage()->getProduct()->getParentId();
		if( $id === null ){ $id = $event->getRequest()->attributes->get('productId'); }

		$criteria = new Criteria();
		$criteria->addFilter( new MultiFilter( MultiFilter::CONNECTION_AND, [
			new EqualsFilter( 'products.id', $id ),
			new NotFilter(NotFilter::CONNECTION_AND,[new EqualsFilter('answer', null)])
		]));

		$response = $this->route->getFaq( $criteria, $event->getSalesChannelContext());

		$event->getPage()->addExtension('faq', $response->getData());
	}
}