<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261005124141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, montant INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE inscription ADD id_facture_id INT NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6DAA76EDF FOREIGN KEY (id_facture_id) REFERENCES facture (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6DAA76EDF ON inscription (id_facture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE facture');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6DAA76EDF');
        $this->addSql('DROP INDEX IDX_5E90F6D6DAA76EDF ON inscription');
        $this->addSql('ALTER TABLE inscription DROP id_facture_id');
    }
}
