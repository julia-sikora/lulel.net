<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230112185611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE filament (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, producer VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, material VARCHAR(255) NOT NULL, temperature_extruder VARCHAR(255) NOT NULL, temperature_table VARCHAR(255) NOT NULL, purchase_date DATETIME NOT NULL, INDEX IDX_9DAA3BA6A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE filament ADD CONSTRAINT FK_9DAA3BA6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filament DROP FOREIGN KEY FK_9DAA3BA6A76ED395');
        $this->addSql('DROP TABLE filament');
    }
}
