<?php declare(strict_types=1);

namespace CodingCase\Core\Content\Faq\SalesChannel;

use CodingCase\Core\Content\Faq\FaqCollection;
use Shopware\Core\System\SalesChannel\StoreApiResponse;

class FaqRouteResponse extends StoreApiResponse
{
	public function __construct( FaqCollection $faqc )
	{
		parent::__construct( $faqc );
	}

	public function getData(): FaqCollection
	{
		return $this->object;
	}
}