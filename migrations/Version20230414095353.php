<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230414095353 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<SQL
UPDATE user SET roles = '["ROLE_ADMIN"]' WHERE id = 1
SQL
        );

    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<SQL
UPDATE user SET roles = '[]' WHERE id = 1
SQL
        );
    }
}
