<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260209083135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE element_securite_intervention (element_securite_id INT NOT NULL, intervention_id INT NOT NULL, INDEX IDX_BD1F4757DDD7F29E (element_securite_id), INDEX IDX_BD1F47578EAE3863 (intervention_id), PRIMARY KEY (element_securite_id, intervention_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE vigilance_intervention (vigilance_id INT NOT NULL, intervention_id INT NOT NULL, INDEX IDX_5AC80BEE8BD1E831 (vigilance_id), INDEX IDX_5AC80BEE8EAE3863 (intervention_id), PRIMARY KEY (vigilance_id, intervention_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE element_securite_intervention ADD CONSTRAINT FK_BD1F4757DDD7F29E FOREIGN KEY (element_securite_id) REFERENCES element_securite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE element_securite_intervention ADD CONSTRAINT FK_BD1F47578EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vigilance_intervention ADD CONSTRAINT FK_5AC80BEE8BD1E831 FOREIGN KEY (vigilance_id) REFERENCES vigilance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vigilance_intervention ADD CONSTRAINT FK_5AC80BEE8EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE redacteur ADD intervention_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE redacteur ADD CONSTRAINT FK_84964B158EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id)');
        $this->addSql('CREATE INDEX IDX_84964B158EAE3863 ON redacteur (intervention_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE element_securite_intervention DROP FOREIGN KEY FK_BD1F4757DDD7F29E');
        $this->addSql('ALTER TABLE element_securite_intervention DROP FOREIGN KEY FK_BD1F47578EAE3863');
        $this->addSql('ALTER TABLE vigilance_intervention DROP FOREIGN KEY FK_5AC80BEE8BD1E831');
        $this->addSql('ALTER TABLE vigilance_intervention DROP FOREIGN KEY FK_5AC80BEE8EAE3863');
        $this->addSql('DROP TABLE element_securite_intervention');
        $this->addSql('DROP TABLE vigilance_intervention');
        $this->addSql('ALTER TABLE redacteur DROP FOREIGN KEY FK_84964B158EAE3863');
        $this->addSql('DROP INDEX IDX_84964B158EAE3863 ON redacteur');
        $this->addSql('ALTER TABLE redacteur DROP intervention_id');
    }
}
