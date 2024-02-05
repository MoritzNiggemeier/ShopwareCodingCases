<?php declare(strict_types=1);

namespace Demo\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1706805349TeamMemberMigration extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1706805349;
    }

        public function update(Connection $connection): void
    {
        $connection->executeStatement('
            CREATE TABLE IF NOT EXISTS `team` (
                `id` BINARY(16) NOT NULL,
                `name` VARCHAR(255),
                `position` VARCHAR(255),
                `text` MEDIUMTEXT,
                `image_id` BINARY(16) NULL,
                `imageBG_id` BINARY(16) NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                PRIMARY KEY (`id`),
                CONSTRAINT `fk.team.image_id` FOREIGN KEY (`image_id`)
                    REFERENCES `media` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
                CONSTRAINT `fk.team.imageBG_id` FOREIGN KEY (`imageBG_id`)
                    REFERENCES `media` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
