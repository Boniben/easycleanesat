<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260209083950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE element_securite (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, picto VARCHAR(255) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE element_securite_intervention (element_securite_id INT NOT NULL, intervention_id INT NOT NULL, INDEX IDX_BD1F4757DDD7F29E (element_securite_id), INDEX IDX_BD1F47578EAE3863 (intervention_id), PRIMARY KEY (element_securite_id, intervention_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE intervention (id INT AUTO_INCREMENT NOT NULL, num_version INT DEFAULT NULL, date_creation DATE DEFAULT NULL, date_modification DATE DEFAULT NULL, nb_travailleur INT DEFAULT NULL, duree_heure INT DEFAULT NULL, duree_minute INT DEFAULT NULL, lundi_mat_hd TIME DEFAULT NULL, lundi_mat_hf TIME DEFAULT NULL, lundi_ap_hd TIME DEFAULT NULL, lundi_ap_hf TIME DEFAULT NULL, mardi_mat_hd TIME DEFAULT NULL, mardi_mat_hf TIME DEFAULT NULL, mardi_ap_hd TIME DEFAULT NULL, mardi_ap_hf TIME DEFAULT NULL, mercredi_mat_hd TIME DEFAULT NULL, mercredi_mat_hf TIME DEFAULT NULL, mercredi_ap_hd TIME DEFAULT NULL, mercredi_ap_hf TIME DEFAULT NULL, jeudi_mat_hd TIME DEFAULT NULL, jeudi_mat_hf TIME DEFAULT NULL, jeudi_ap_hd TIME DEFAULT NULL, jeudi_ap_hf TIME DEFAULT NULL, vendredi_mat_hd TIME DEFAULT NULL, vendredi_mat_hf TIME DEFAULT NULL, vendredi_ap_hd TIME DEFAULT NULL, vendredi_ap_hf TIME DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE redacteur (id INT AUTO_INCREMENT NOT NULL, initial VARCHAR(50) DEFAULT NULL, intervention_id INT DEFAULT NULL, INDEX IDX_84964B158EAE3863 (intervention_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE vigilance (id INT AUTO_INCREMENT NOT NULL, definition VARCHAR(255) DEFAULT NULL, picto VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE vigilance_intervention (vigilance_id INT NOT NULL, intervention_id INT NOT NULL, INDEX IDX_5AC80BEE8BD1E831 (vigilance_id), INDEX IDX_5AC80BEE8EAE3863 (intervention_id), PRIMARY KEY (vigilance_id, intervention_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE element_securite_intervention ADD CONSTRAINT FK_BD1F4757DDD7F29E FOREIGN KEY (element_securite_id) REFERENCES element_securite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE element_securite_intervention ADD CONSTRAINT FK_BD1F47578EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE redacteur ADD CONSTRAINT FK_84964B158EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id)');
        $this->addSql('ALTER TABLE vigilance_intervention ADD CONSTRAINT FK_5AC80BEE8BD1E831 FOREIGN KEY (vigilance_id) REFERENCES vigilance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vigilance_intervention ADD CONSTRAINT FK_5AC80BEE8EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE element_securite_intervention DROP FOREIGN KEY FK_BD1F4757DDD7F29E');
        $this->addSql('ALTER TABLE element_securite_intervention DROP FOREIGN KEY FK_BD1F47578EAE3863');
        $this->addSql('ALTER TABLE redacteur DROP FOREIGN KEY FK_84964B158EAE3863');
        $this->addSql('ALTER TABLE vigilance_intervention DROP FOREIGN KEY FK_5AC80BEE8BD1E831');
        $this->addSql('ALTER TABLE vigilance_intervention DROP FOREIGN KEY FK_5AC80BEE8EAE3863');
        $this->addSql('DROP TABLE element_securite');
        $this->addSql('DROP TABLE element_securite_intervention');
        $this->addSql('DROP TABLE intervention');
        $this->addSql('DROP TABLE redacteur');
        $this->addSql('DROP TABLE vigilance');
        $this->addSql('DROP TABLE vigilance_intervention');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
