<?php declare(strict_types=1);

namespace CodingCase\Core\Content\Faq\SalesChannel;

use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;

abstract class AbstractFaqRoute
{
	abstract public function getDecorated(): AbstractFaqRoute;
	abstract public function getFaq(Criteria $criteria, SalesChannelContext $context): FaqRouteResponse;
	abstract public function setFaq(string $question, string $productId): bool;
}