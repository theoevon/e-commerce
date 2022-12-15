<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221214161133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feature DROP FOREIGN KEY FK_1FD775669EE32978');
        $this->addSql('DROP INDEX IDX_1FD775669EE32978 ON feature');
        $this->addSql('ALTER TABLE feature CHANGE id_variant id_variant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE feature ADD CONSTRAINT FK_1FD775669EE32978 FOREIGN KEY (id_variant_id) REFERENCES feature (id)');
        $this->addSql('CREATE INDEX IDX_1FD775669EE32978 ON feature (id_variant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feature DROP FOREIGN KEY FK_1FD775669EE32978');
        $this->addSql('DROP INDEX IDX_1FD775669EE32978 ON feature');
        $this->addSql('ALTER TABLE feature CHANGE id_variant_id id_variant INT DEFAULT NULL');
        $this->addSql('ALTER TABLE feature ADD CONSTRAINT FK_1FD775669EE32978 FOREIGN KEY (id_variant) REFERENCES feature (id)');
        $this->addSql('CREATE INDEX IDX_1FD775669EE32978 ON feature (id_variant)');
    }
}
