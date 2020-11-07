<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201013143402 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, nom_role VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entretien CHANGE description_entretien description_entretien VARCHAR(70) DEFAULT NULL');
        $this->addSql('ALTER TABLE fournir_materiel CHANGE prix_materiel prix_materiel INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fournir_mobilier CHANGE prix_mobilier prix_mobilier INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE role');
        $this->addSql('ALTER TABLE entretien CHANGE description_entretien description_entretien VARCHAR(70) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE fournir_materiel CHANGE prix_materiel prix_materiel INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fournir_mobilier CHANGE prix_mobilier prix_mobilier INT DEFAULT NULL');
    }
}
