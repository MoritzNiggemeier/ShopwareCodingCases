<?php declare(strict_types=1);

namespace CodingCase\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;
use Shopware\Core\Framework\Migration\InheritanceUpdaterTrait;

class Migration1704067200Faq extends MigrationStep
{
	use InheritanceUpdaterTrait;

	public function getCreationTimestamp(): int
	{
		return 1704067200;
	}

	public function update(Connection $connection): void
	{
		$this->createFaqTable( $connection );
		$this->createFaqProductTable( $connection );
		$this->updateInheritance($connection, 'product', 'faqs');
	}

	public function updateDestructive(Connection $connection): void
	{
	}

	public function createFaqTable(Connection $connection): void
	{
		$connection->executeUpdate('
			CREATE TABLE IF NOT EXISTS `faq` (
				`id` BINARY(16) NOT NULL,
				`question` VARCHAR(255) NOT NULL,
				`answer` VARCHAR(255) NULL,
				`created_at` DATETIME(3) NOT NULL,
				`updated_at` DATETIME(3) NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
		');
	}

	public function createFaqProductTable(Connection $connection): void
	{
		$connection->executeUpdate('
			CREATE TABLE IF NOT EXISTS `faq_product` (
				`faq_id` BINARY(16) NOT NULL,
				`product_id` BINARY(16) NOT NULL,
				`product_version_id` BINARY(16) NOT NULL,
				PRIMARY KEY (`faq_id`,`product_id`,`product_version_id`),
				KEY `fk.faq_product.faq_id` (`faq_id`),
				KEY `fk.faq_product.product_id` (`product_id`,`product_version_id`),
				CONSTRAINT `fk.faq_product.faq_id` FOREIGN KEY (`faq_id`)
					REFERENCES `faq` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
				CONSTRAINT `fk.faq_product.product_id` FOREIGN KEY (`product_id`,`product_version_id`)
					REFERENCES `product` (`id`,`version_id`) ON DELETE CASCADE ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
		');
	}

}