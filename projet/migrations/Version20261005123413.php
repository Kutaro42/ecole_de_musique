<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261005123413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, coeff_famillial INT NOT NULL, prix INT NOT NULL, jour VARCHAR(40) NOT NULL, horaire_debut VARCHAR(50) NOT NULL, horaire_fin VARCHAR(50) NOT NULL, police_assurance VARCHAR(255) NOT NULL, id_eleve_id INT NOT NULL, INDEX IDX_5E90F6D65AB72B27 (id_eleve_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D65AB72B27 FOREIGN KEY (id_eleve_id) REFERENCES eleve (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D65AB72B27');
        $this->addSql('DROP TABLE inscription');
    }
}
