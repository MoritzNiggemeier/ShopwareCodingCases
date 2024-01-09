<?php declare(strict_types=1);

namespace CodingCase;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\ActivateContext;
use Shopware\Core\Framework\Plugin\Context\DeactivateContext;
use Shopware\Core\Framework\Plugin\Context\InstallContext;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;
use Shopware\Core\Framework\Plugin\Context\UpdateContext;
use Shopware\Core\Framework\DataAbstractionLayer\Indexing\EntityIndexerRegistry;

class FrequentlyAskedQuestionsPlugin extends Plugin
{
	public function install(InstallContext $installContext): void
	{
	}

	public function uninstall(UninstallContext $uninstallContext): void
	{
		parent::uninstall($uninstallContext);
		if ($uninstallContext->keepUserData()){ return; }
		$connection = $this->container->get(Connection::class);
		$connection->executeUpdate('ALTER TABLE `product` DROP COLUMN `faqs`');
		$connection->executeUpdate('DROP TABLE IF EXISTS `faq_product`');
		$connection->executeUpdate('DROP TABLE IF EXISTS `faq`');

	}

	public function activate(ActivateContext $activateContext): void
	{
		$entityIndexerRegistry = $this->container->get(EntityIndexerRegistry::class);
		$entityIndexerRegistry->sendIndexingMessage(['product.indexer']);
	}

	public function deactivate(DeactivateContext $deactivateContext): void
	{
	}

	public function update(UpdateContext $updateContext): void
	{
	}

	public function postInstall(InstallContext $installContext): void
	{
	}

	public function postUpdate(UpdateContext $updateContext): void
	{
	}

}