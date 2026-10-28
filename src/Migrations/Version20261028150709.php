<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261028150709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artiste (id INT AUTO_INCREMENT NOT NULL, pseudonyme VARCHAR(100) NOT NULL, nom_reel VARCHAR(100) DEFAULT NULL, bio LONGTEXT DEFAULT NULL, nationalite VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_9C07354F1FE3BDAF (pseudonyme), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE benevole (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B4014FDBE7927C74 (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE lieu (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, adresse VARCHAR(200) DEFAULT NULL, quartier VARCHAR(50) DEFAULT NULL, latitude NUMERIC(9, 7) DEFAULT NULL, longitude NUMERIC(9, 7) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE oeuvre (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(50) NOT NULL, date_creation DATETIME NOT NULL, description LONGTEXT DEFAULT NULL, est_detruite TINYINT NOT NULL, lieu_id INT NOT NULL, oeuvre_recouverte_id INT DEFAULT NULL, INDEX IDX_35FE2EFE6AB213CC (lieu_id), INDEX IDX_35FE2EFEEAFC6390 (oeuvre_recouverte_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE oeuvre_artiste (oeuvre_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_DB75DF1488194DE8 (oeuvre_id), INDEX IDX_DB75DF1421D25844 (artiste_id), PRIMARY KEY (oeuvre_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE oeuvre_technique (oeuvre_id INT NOT NULL, technique_id INT NOT NULL, INDEX IDX_CEAB50CA88194DE8 (oeuvre_id), INDEX IDX_CEAB50CA1F8ACB26 (technique_id), PRIMARY KEY (oeuvre_id, technique_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, date_prise_vue DATETIME NOT NULL, nom_fichier VARCHAR(255) NOT NULL, etat_oeuvre VARCHAR(500) DEFAULT NULL, oeuvre_id INT NOT NULL, benevole_id INT NOT NULL, INDEX IDX_14B7841888194DE8 (oeuvre_id), INDEX IDX_14B78418E77B7C09 (benevole_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE technique (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_D73B98416C6E55B5 (nom), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE oeuvre ADD CONSTRAINT FK_35FE2EFE6AB213CC FOREIGN KEY (lieu_id) REFERENCES lieu (id)');
        $this->addSql('ALTER TABLE oeuvre ADD CONSTRAINT FK_35FE2EFEEAFC6390 FOREIGN KEY (oeuvre_recouverte_id) REFERENCES oeuvre (id)');
        $this->addSql('ALTER TABLE oeuvre_artiste ADD CONSTRAINT FK_DB75DF1488194DE8 FOREIGN KEY (oeuvre_id) REFERENCES oeuvre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvre_artiste ADD CONSTRAINT FK_DB75DF1421D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvre_technique ADD CONSTRAINT FK_CEAB50CA88194DE8 FOREIGN KEY (oeuvre_id) REFERENCES oeuvre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvre_technique ADD CONSTRAINT FK_CEAB50CA1F8ACB26 FOREIGN KEY (technique_id) REFERENCES technique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B7841888194DE8 FOREIGN KEY (oeuvre_id) REFERENCES oeuvre (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418E77B7C09 FOREIGN KEY (benevole_id) REFERENCES benevole (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oeuvre DROP FOREIGN KEY FK_35FE2EFE6AB213CC');
        $this->addSql('ALTER TABLE oeuvre DROP FOREIGN KEY FK_35FE2EFEEAFC6390');
        $this->addSql('ALTER TABLE oeuvre_artiste DROP FOREIGN KEY FK_DB75DF1488194DE8');
        $this->addSql('ALTER TABLE oeuvre_artiste DROP FOREIGN KEY FK_DB75DF1421D25844');
        $this->addSql('ALTER TABLE oeuvre_technique DROP FOREIGN KEY FK_CEAB50CA88194DE8');
        $this->addSql('ALTER TABLE oeuvre_technique DROP FOREIGN KEY FK_CEAB50CA1F8ACB26');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B7841888194DE8');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418E77B7C09');
        $this->addSql('DROP TABLE artiste');
        $this->addSql('DROP TABLE benevole');
        $this->addSql('DROP TABLE lieu');
        $this->addSql('DROP TABLE oeuvre');
        $this->addSql('DROP TABLE oeuvre_artiste');
        $this->addSql('DROP TABLE oeuvre_technique');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE technique');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
