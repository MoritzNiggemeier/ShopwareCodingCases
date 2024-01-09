<?php declare(strict_types=1);

namespace CodingCase\Core\Content\Faq\SalesChannel;

use Exception;
use Shopware\Core\Framework\Context;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Plugin\Exception\DecorationPatternException;
use Symfony\Component\Routing\Annotation\Route;

#[Route(defaults: ['_routeScope' => ['store-api']])]
class FaqRoute extends AbstractFaqRoute
{
	protected EntityRepository $repo;

	public function __construct(EntityRepository $repo)
	{
		$this->repo = $repo;
	}

	public function getDecorated(): AbstractFaqRoute
	{
		throw new DecorationPatternException(self::class);
	}

	#[Route(path: '/store-api/getfaq', name: 'store-api.faq.get', methods: ['POST'], defaults: ['_entity' => 'faq'])]
	public function getFaq(Criteria $criteria, SalesChannelContext $context): FaqRouteResponse
	{
		return new FaqRouteResponse(
			$this->repo
			->search($criteria, $context->getContext())
			->getEntities()
		);
	}

	#[Route(path: '/store-api/setfaq', name: 'store-api.faq.set', methods: ['POST'], defaults: ['_entity' => 'faq'])]
	public function setFaq(string $question, string $productId): bool
	{
		try {
			$this->repo->create([
				[
					'question' => $question,
					'products' => [['id' => $productId]]
				]
			], Context::createDefaultContext());
			return true;
		}
		catch (Exception $e) { return false; }
	}

}