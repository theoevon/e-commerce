<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221208132006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD variant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F3B69A9AF FOREIGN KEY (variant_id) REFERENCES variant (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F3B69A9AF ON image (variant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F3B69A9AF');
        $this->addSql('DROP INDEX IDX_C53D045F3B69A9AF ON image');
        $this->addSql('ALTER TABLE image DROP variant_id');
    }
}
