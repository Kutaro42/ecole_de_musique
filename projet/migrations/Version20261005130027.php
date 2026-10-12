<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261005130027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription ADD id_responsable_legal_1_id INT DEFAULT NULL, ADD id_responsable_legal_2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D62950F6DA FOREIGN KEY (id_responsable_legal_1_id) REFERENCES responsablelegal (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D63BE55934 FOREIGN KEY (id_responsable_legal_2_id) REFERENCES responsablelegal (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D62950F6DA ON inscription (id_responsable_legal_1_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D63BE55934 ON inscription (id_responsable_legal_2_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D62950F6DA');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D63BE55934');
        $this->addSql('DROP INDEX IDX_5E90F6D62950F6DA ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D63BE55934 ON inscription');
        $this->addSql('ALTER TABLE inscription DROP id_responsable_legal_1_id, DROP id_responsable_legal_2_id');
    }
}
