<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201008150725 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle_categ VARCHAR(15) NOT NULL, description_categ VARCHAR(60) NOT NULL, UNIQUE INDEX UNIQ_497DD634CD59BB39 (libelle_categ), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE declaration (id INT AUTO_INCREMENT NOT NULL, detenteurs_id INT NOT NULL, contenu VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7AA3DAC289C2003F (contenu), INDEX IDX_7AA3DAC255B89984 (detenteurs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detenir_materiel (id INT AUTO_INCREMENT NOT NULL, detenteurs_id INT NOT NULL, materiels_id INT NOT NULL, date_sortie DATETIME NOT NULL, qte_sortie INT NOT NULL, lieu VARCHAR(70) NOT NULL, date_retour DATETIME NOT NULL, INDEX IDX_5830877F55B89984 (detenteurs_id), INDEX IDX_5830877FA10E8B56 (materiels_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detenir_mobilier (id INT AUTO_INCREMENT NOT NULL, detenteurs_id INT NOT NULL, mobiliers_id INT NOT NULL, date_sortie DATE NOT NULL, qte_sortie INT NOT NULL, lieu VARCHAR(100) NOT NULL, date_retour DATE NOT NULL, INDEX IDX_52B9ED6A55B89984 (detenteurs_id), INDEX IDX_52B9ED6A891DA811 (mobiliers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detenteur (id INT AUTO_INCREMENT NOT NULL, fonction_id INT NOT NULL, nom_detenteur VARCHAR(100) NOT NULL, contact INT NOT NULL, UNIQUE INDEX UNIQ_5F936A87CB621BC6 (nom_detenteur), INDEX IDX_5F936A8757889920 (fonction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entretien (id INT AUTO_INCREMENT NOT NULL, mobiliers_id INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, prix INT NOT NULL, description_entretien VARCHAR(70) DEFAULT NULL, INDEX IDX_2B58D6DA891DA811 (mobiliers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fonction (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(40) NOT NULL, UNIQUE INDEX UNIQ_900D5BDA4D60759 (libelle), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournir_materiel (id INT AUTO_INCREMENT NOT NULL, sources_id INT NOT NULL, materiels_id INT NOT NULL, date_entree DATE NOT NULL, qte_entree INT NOT NULL, nature VARCHAR(10) NOT NULL, prix_materiel INT DEFAULT NULL, INDEX IDX_ECE49EFEDD51D0F7 (sources_id), INDEX IDX_ECE49EFEA10E8B56 (materiels_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournir_mobilier (id INT AUTO_INCREMENT NOT NULL, sources_id INT NOT NULL, mobiliers_id INT NOT NULL, date_entree DATE NOT NULL, prix_mobilier INT DEFAULT NULL, nature VARCHAR(10) NOT NULL, INDEX IDX_E66DF4EBDD51D0F7 (sources_id), INDEX IDX_E66DF4EB891DA811 (mobiliers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, categorie_materiel_id INT NOT NULL, nomenclature VARCHAR(60) NOT NULL, designation VARCHAR(20) NOT NULL, qte_initiale INT NOT NULL, stock INT NOT NULL, stock_alerte INT NOT NULL, service TINYINT(1) NOT NULL, etat_retour_materiel VARCHAR(8) NOT NULL, UNIQUE INDEX UNIQ_18D2B091799A3652 (nomenclature), INDEX IDX_18D2B091C9762CA6 (categorie_materiel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mobilier (id INT AUTO_INCREMENT NOT NULL, categorie_mobilier_id INT NOT NULL, code_mobilier VARCHAR(10) NOT NULL, designation VARCHAR(60) NOT NULL, etat VARCHAR(9) NOT NULL, service TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_125BDA84EBDAA2AF (code_mobilier), INDEX IDX_125BDA84D8EDF59E (categorie_mobilier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source (id INT AUTO_INCREMENT NOT NULL, nom_source VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_5F8A7F73DF45E024 (nom_source), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(70) NOT NULL, password VARCHAR(100) NOT NULL, email VARCHAR(70) NOT NULL, role VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE declaration ADD CONSTRAINT FK_7AA3DAC255B89984 FOREIGN KEY (detenteurs_id) REFERENCES detenteur (id)');
        $this->addSql('ALTER TABLE detenir_materiel ADD CONSTRAINT FK_5830877F55B89984 FOREIGN KEY (detenteurs_id) REFERENCES detenteur (id)');
        $this->addSql('ALTER TABLE detenir_materiel ADD CONSTRAINT FK_5830877FA10E8B56 FOREIGN KEY (materiels_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE detenir_mobilier ADD CONSTRAINT FK_52B9ED6A55B89984 FOREIGN KEY (detenteurs_id) REFERENCES detenteur (id)');
        $this->addSql('ALTER TABLE detenir_mobilier ADD CONSTRAINT FK_52B9ED6A891DA811 FOREIGN KEY (mobiliers_id) REFERENCES mobilier (id)');
        $this->addSql('ALTER TABLE detenteur ADD CONSTRAINT FK_5F936A8757889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id)');
        $this->addSql('ALTER TABLE entretien ADD CONSTRAINT FK_2B58D6DA891DA811 FOREIGN KEY (mobiliers_id) REFERENCES mobilier (id)');
        $this->addSql('ALTER TABLE fournir_materiel ADD CONSTRAINT FK_ECE49EFEDD51D0F7 FOREIGN KEY (sources_id) REFERENCES source (id)');
        $this->addSql('ALTER TABLE fournir_materiel ADD CONSTRAINT FK_ECE49EFEA10E8B56 FOREIGN KEY (materiels_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE fournir_mobilier ADD CONSTRAINT FK_E66DF4EBDD51D0F7 FOREIGN KEY (sources_id) REFERENCES source (id)');
        $this->addSql('ALTER TABLE fournir_mobilier ADD CONSTRAINT FK_E66DF4EB891DA811 FOREIGN KEY (mobiliers_id) REFERENCES mobilier (id)');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B091C9762CA6 FOREIGN KEY (categorie_materiel_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE mobilier ADD CONSTRAINT FK_125BDA84D8EDF59E FOREIGN KEY (categorie_mobilier_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B091C9762CA6');
        $this->addSql('ALTER TABLE mobilier DROP FOREIGN KEY FK_125BDA84D8EDF59E');
        $this->addSql('ALTER TABLE declaration DROP FOREIGN KEY FK_7AA3DAC255B89984');
        $this->addSql('ALTER TABLE detenir_materiel DROP FOREIGN KEY FK_5830877F55B89984');
        $this->addSql('ALTER TABLE detenir_mobilier DROP FOREIGN KEY FK_52B9ED6A55B89984');
        $this->addSql('ALTER TABLE detenteur DROP FOREIGN KEY FK_5F936A8757889920');
        $this->addSql('ALTER TABLE detenir_materiel DROP FOREIGN KEY FK_5830877FA10E8B56');
        $this->addSql('ALTER TABLE fournir_materiel DROP FOREIGN KEY FK_ECE49EFEA10E8B56');
        $this->addSql('ALTER TABLE detenir_mobilier DROP FOREIGN KEY FK_52B9ED6A891DA811');
        $this->addSql('ALTER TABLE entretien DROP FOREIGN KEY FK_2B58D6DA891DA811');
        $this->addSql('ALTER TABLE fournir_mobilier DROP FOREIGN KEY FK_E66DF4EB891DA811');
        $this->addSql('ALTER TABLE fournir_materiel DROP FOREIGN KEY FK_ECE49EFEDD51D0F7');
        $this->addSql('ALTER TABLE fournir_mobilier DROP FOREIGN KEY FK_E66DF4EBDD51D0F7');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE declaration');
        $this->addSql('DROP TABLE detenir_materiel');
        $this->addSql('DROP TABLE detenir_mobilier');
        $this->addSql('DROP TABLE detenteur');
        $this->addSql('DROP TABLE entretien');
        $this->addSql('DROP TABLE fonction');
        $this->addSql('DROP TABLE fournir_materiel');
        $this->addSql('DROP TABLE fournir_mobilier');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE mobilier');
        $this->addSql('DROP TABLE source');
        $this->addSql('DROP TABLE user');
    }
}
