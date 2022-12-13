<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221213152355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articlesales DROP FOREIGN KEY FK_86E6875EA4522A07');
        $this->addSql('DROP INDEX IDX_86E6875EA4522A07 ON articlesales');
        $this->addSql('ALTER TABLE articlesales ADD promotion INT NOT NULL, DROP sales_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articlesales ADD sales_id INT DEFAULT NULL, DROP promotion');
        $this->addSql('ALTER TABLE articlesales ADD CONSTRAINT FK_86E6875EA4522A07 FOREIGN KEY (sales_id) REFERENCES sales (id)');
        $this->addSql('CREATE INDEX IDX_86E6875EA4522A07 ON articlesales (sales_id)');
    }
}
