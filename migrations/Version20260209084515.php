<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260209084515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE contrat (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(50) NOT NULL, sites_client_id INT NOT NULL, INDEX IDX_60349993F8F85AE9 (sites_client_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE sites_client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, client_id INT DEFAULT NULL, INDEX IDX_6B0A760419EB6921 (client_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE support_client (id INT AUTO_INCREMENT NOT NULL, zones_client_id INT DEFAULT NULL, type_support_id INT NOT NULL, INDEX IDX_4FBEE4A5F810C6CC (zones_client_id), INDEX IDX_4FBEE4A51E166220 (type_support_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE type_support (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, picto VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE type_zone (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, picto VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE zones_client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, sites_client_id INT DEFAULT NULL, type_zone_id INT DEFAULT NULL, INDEX IDX_2E9A97F7F8F85AE9 (sites_client_id), INDEX IDX_2E9A97F7B70D505E (type_zone_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_60349993F8F85AE9 FOREIGN KEY (sites_client_id) REFERENCES sites_client (id)');
        $this->addSql('ALTER TABLE sites_client ADD CONSTRAINT FK_6B0A760419EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE support_client ADD CONSTRAINT FK_4FBEE4A5F810C6CC FOREIGN KEY (zones_client_id) REFERENCES zones_client (id)');
        $this->addSql('ALTER TABLE support_client ADD CONSTRAINT FK_4FBEE4A51E166220 FOREIGN KEY (type_support_id) REFERENCES type_support (id)');
        $this->addSql('ALTER TABLE zones_client ADD CONSTRAINT FK_2E9A97F7F8F85AE9 FOREIGN KEY (sites_client_id) REFERENCES sites_client (id)');
        $this->addSql('ALTER TABLE zones_client ADD CONSTRAINT FK_2E9A97F7B70D505E FOREIGN KEY (type_zone_id) REFERENCES type_zone (id)');
        $this->addSql('ALTER TABLE element_securite_intervention DROP FOREIGN KEY `FK_BD1F47578EAE3863`');
        $this->addSql('ALTER TABLE element_securite_intervention DROP FOREIGN KEY `FK_BD1F4757DDD7F29E`');
        $this->addSql('ALTER TABLE redacteur DROP FOREIGN KEY `FK_84964B158EAE3863`');
        $this->addSql('ALTER TABLE vigilance_intervention DROP FOREIGN KEY `FK_5AC80BEE8BD1E831`');
        $this->addSql('ALTER TABLE vigilance_intervention DROP FOREIGN KEY `FK_5AC80BEE8EAE3863`');
        $this->addSql('DROP TABLE actions');
        $this->addSql('DROP TABLE element_securite');
        $this->addSql('DROP TABLE element_securite_intervention');
        $this->addSql('DROP TABLE intervention');
        $this->addSql('DROP TABLE redacteur');
        $this->addSql('DROP TABLE vigilance');
        $this->addSql('DROP TABLE vigilance_intervention');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actions (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE element_securite (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, picto VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE element_securite_intervention (element_securite_id INT NOT NULL, intervention_id INT NOT NULL, INDEX IDX_BD1F4757DDD7F29E (element_securite_id), INDEX IDX_BD1F47578EAE3863 (intervention_id), PRIMARY KEY (element_securite_id, intervention_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE intervention (id INT AUTO_INCREMENT NOT NULL, num_version INT DEFAULT NULL, date_creation DATE DEFAULT NULL, date_modification DATE DEFAULT NULL, nb_travailleur INT DEFAULT NULL, duree_heure INT DEFAULT NULL, duree_minute INT DEFAULT NULL, lundi_mat_hd TIME DEFAULT NULL, lundi_mat_hf TIME DEFAULT NULL, lundi_ap_hd TIME DEFAULT NULL, lundi_ap_hf TIME DEFAULT NULL, mardi_mat_hd TIME DEFAULT NULL, mardi_mat_hf TIME DEFAULT NULL, mardi_ap_hd TIME DEFAULT NULL, mardi_ap_hf TIME DEFAULT NULL, mercredi_mat_hd TIME DEFAULT NULL, mercredi_mat_hf TIME DEFAULT NULL, mercredi_ap_hd TIME DEFAULT NULL, mercredi_ap_hf TIME DEFAULT NULL, jeudi_mat_hd TIME DEFAULT NULL, jeudi_mat_hf TIME DEFAULT NULL, jeudi_ap_hd TIME DEFAULT NULL, jeudi_ap_hf TIME DEFAULT NULL, vendredi_mat_hd TIME DEFAULT NULL, vendredi_mat_hf TIME DEFAULT NULL, vendredi_ap_hd TIME DEFAULT NULL, vendredi_ap_hf TIME DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE redacteur (id INT AUTO_INCREMENT NOT NULL, initial VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, intervention_id INT DEFAULT NULL, INDEX IDX_84964B158EAE3863 (intervention_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE vigilance (id INT AUTO_INCREMENT NOT NULL, definition VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, picto VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE vigilance_intervention (vigilance_id INT NOT NULL, intervention_id INT NOT NULL, INDEX IDX_5AC80BEE8BD1E831 (vigilance_id), INDEX IDX_5AC80BEE8EAE3863 (intervention_id), PRIMARY KEY (vigilance_id, intervention_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE element_securite_intervention ADD CONSTRAINT `FK_BD1F47578EAE3863` FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE element_securite_intervention ADD CONSTRAINT `FK_BD1F4757DDD7F29E` FOREIGN KEY (element_securite_id) REFERENCES element_securite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE redacteur ADD CONSTRAINT `FK_84964B158EAE3863` FOREIGN KEY (intervention_id) REFERENCES intervention (id)');
        $this->addSql('ALTER TABLE vigilance_intervention ADD CONSTRAINT `FK_5AC80BEE8BD1E831` FOREIGN KEY (vigilance_id) REFERENCES vigilance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vigilance_intervention ADD CONSTRAINT `FK_5AC80BEE8EAE3863` FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_60349993F8F85AE9');
        $this->addSql('ALTER TABLE sites_client DROP FOREIGN KEY FK_6B0A760419EB6921');
        $this->addSql('ALTER TABLE support_client DROP FOREIGN KEY FK_4FBEE4A5F810C6CC');
        $this->addSql('ALTER TABLE support_client DROP FOREIGN KEY FK_4FBEE4A51E166220');
        $this->addSql('ALTER TABLE zones_client DROP FOREIGN KEY FK_2E9A97F7F8F85AE9');
        $this->addSql('ALTER TABLE zones_client DROP FOREIGN KEY FK_2E9A97F7B70D505E');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('DROP TABLE sites_client');
        $this->addSql('DROP TABLE support_client');
        $this->addSql('DROP TABLE type_support');
        $this->addSql('DROP TABLE type_zone');
        $this->addSql('DROP TABLE zones_client');
    }
}
