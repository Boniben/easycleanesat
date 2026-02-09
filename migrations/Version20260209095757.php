<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260209095757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vigilance_intervention (id INT AUTO_INCREMENT NOT NULL, detail VARCHAR(255) DEFAULT NULL, vigilance_id INT DEFAULT NULL, intervention_id INT DEFAULT NULL, INDEX IDX_5AC80BEE8BD1E831 (vigilance_id), INDEX IDX_5AC80BEE8EAE3863 (intervention_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE vigilance_intervention ADD CONSTRAINT FK_5AC80BEE8BD1E831 FOREIGN KEY (vigilance_id) REFERENCES vigilance (id)');
        $this->addSql('ALTER TABLE vigilance_intervention ADD CONSTRAINT FK_5AC80BEE8EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vigilance_intervention DROP FOREIGN KEY FK_5AC80BEE8BD1E831');
        $this->addSql('ALTER TABLE vigilance_intervention DROP FOREIGN KEY FK_5AC80BEE8EAE3863');
        $this->addSql('DROP TABLE vigilance_intervention');
    }
}
