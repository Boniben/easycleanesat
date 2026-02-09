<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260209090553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actions ADD accessoire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE actions ADD CONSTRAINT FK_548F1EFD23B67ED FOREIGN KEY (accessoire_id) REFERENCES accessoire (id)');
        $this->addSql('CREATE INDEX IDX_548F1EFD23B67ED ON actions (accessoire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actions DROP FOREIGN KEY FK_548F1EFD23B67ED');
        $this->addSql('DROP INDEX IDX_548F1EFD23B67ED ON actions');
        $this->addSql('ALTER TABLE actions DROP accessoire_id');
    }
}
