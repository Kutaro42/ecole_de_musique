<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261015074116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL, CHANGE date_naissance date_naissance DATE DEFAULT NULL, CHANGE adresse_principale adresse_principale VARCHAR(255) DEFAULT NULL, CHANGE age age INT DEFAULT NULL, CHANGE tel_domicile tel_domicile VARCHAR(50) DEFAULT NULL, CHANGE tel_portable tel_portable VARCHAR(50) DEFAULT NULL, CHANGE tel_professionnel tel_professionnel VARCHAR(50) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE eleve_majeur eleve_majeur TINYINT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY `FK_5E90F6D62E149425`');
        $this->addSql('DROP INDEX IDX_5E90F6D62E149425 ON inscription');
        $this->addSql('ALTER TABLE inscription ADD id_discipline_id INT NOT NULL, CHANGE id_cours_id id_cours INT NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6134FCDAC FOREIGN KEY (id_cours) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D61B7AF664 FOREIGN KEY (id_discipline_id) REFERENCES discipline (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6134FCDAC ON inscription (id_cours)');
        $this->addSql('CREATE INDEX IDX_5E90F6D61B7AF664 ON inscription (id_discipline_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL, CHANGE date_naissance date_naissance VARCHAR(255) NOT NULL, CHANGE adresse_principale adresse_principale VARCHAR(255) NOT NULL, CHANGE age age INT NOT NULL, CHANGE tel_domicile tel_domicile VARCHAR(20) NOT NULL, CHANGE tel_portable tel_portable VARCHAR(20) NOT NULL, CHANGE tel_professionnel tel_professionnel VARCHAR(20) NOT NULL, CHANGE email email VARCHAR(50) NOT NULL, CHANGE eleve_majeur eleve_majeur TINYINT NOT NULL');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6134FCDAC');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D61B7AF664');
        $this->addSql('DROP INDEX IDX_5E90F6D6134FCDAC ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D61B7AF664 ON inscription');
        $this->addSql('ALTER TABLE inscription ADD id_cours_id INT NOT NULL, DROP id_cours, DROP id_discipline_id');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT `FK_5E90F6D62E149425` FOREIGN KEY (id_cours_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D62E149425 ON inscription (id_cours_id)');
    }
}
