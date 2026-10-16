<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261015075606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve DROP cycle_musical');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY `FK_5E90F6D6134FCDAC`');
        $this->addSql('DROP INDEX IDX_5E90F6D6134FCDAC ON inscription');
        $this->addSql('ALTER TABLE inscription DROP id_cours');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve ADD cycle_musical INT NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD id_cours INT NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT `FK_5E90F6D6134FCDAC` FOREIGN KEY (id_cours) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6134FCDAC ON inscription (id_cours)');
    }
}
