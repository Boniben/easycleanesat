<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260209094048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE support (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, code VARCHAR(10) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE tache (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(10) NOT NULL, nom VARCHAR(50) NOT NULL, picto VARCHAR(50) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE actions ADD tache_id INT DEFAULT NULL, ADD support_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE actions ADD CONSTRAINT FK_548F1EFD2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE actions ADD CONSTRAINT FK_548F1EF315B405 FOREIGN KEY (support_id) REFERENCES support (id)');
        $this->addSql('CREATE INDEX IDX_548F1EFD2235D39 ON actions (tache_id)');
        $this->addSql('CREATE INDEX IDX_548F1EF315B405 ON actions (support_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE support');
        $this->addSql('DROP TABLE tache');
        $this->addSql('ALTER TABLE actions DROP FOREIGN KEY FK_548F1EFD2235D39');
        $this->addSql('ALTER TABLE actions DROP FOREIGN KEY FK_548F1EF315B405');
        $this->addSql('DROP INDEX IDX_548F1EFD2235D39 ON actions');
        $this->addSql('DROP INDEX IDX_548F1EF315B405 ON actions');
        $this->addSql('ALTER TABLE actions DROP tache_id, DROP support_id');
    }
}
