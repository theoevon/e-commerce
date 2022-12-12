<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221208103101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD category_id INT DEFAULT NULL, ADD sub_category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66F7BFE87C FOREIGN KEY (sub_category_id) REFERENCES sub_category (id)');
        $this->addSql('CREATE INDEX IDX_23A0E6612469DE2 ON article (category_id)');
        $this->addSql('CREATE INDEX IDX_23A0E66F7BFE87C ON article (sub_category_id)');
        $this->addSql('ALTER TABLE feature ADD content LONGTEXT NOT NULL, DROP type, DROP value, DROP is_sortable, CHANGE id_variant id_article INT NOT NULL');
        $this->addSql('ALTER TABLE variant ADD color VARCHAR(255) DEFAULT NULL, DROP name, CHANGE price price LONGTEXT DEFAULT NULL, CHANGE stock size INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE variant ADD name VARCHAR(255) NOT NULL, DROP color, CHANGE price price INT NOT NULL, CHANGE size stock INT NOT NULL');
        $this->addSql('ALTER TABLE feature ADD type VARCHAR(255) NOT NULL, ADD value VARCHAR(255) NOT NULL, ADD is_sortable TINYINT(1) NOT NULL, DROP content, CHANGE id_article id_variant INT NOT NULL');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6612469DE2');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66F7BFE87C');
        $this->addSql('DROP INDEX IDX_23A0E6612469DE2 ON article');
        $this->addSql('DROP INDEX IDX_23A0E66F7BFE87C ON article');
        $this->addSql('ALTER TABLE article DROP category_id, DROP sub_category_id');
    }
}
