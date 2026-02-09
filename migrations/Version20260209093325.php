<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260209093325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actions ADD reutilisable_id INT DEFAULT NULL, ADD consommable_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE actions ADD CONSTRAINT FK_548F1EF627A7912 FOREIGN KEY (reutilisable_id) REFERENCES reutilisable (id)');
        $this->addSql('ALTER TABLE actions ADD CONSTRAINT FK_548F1EFC9CEB381 FOREIGN KEY (consommable_id) REFERENCES consommable (id)');
        $this->addSql('CREATE INDEX IDX_548F1EF627A7912 ON actions (reutilisable_id)');
        $this->addSql('CREATE INDEX IDX_548F1EFC9CEB381 ON actions (consommable_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actions DROP FOREIGN KEY FK_548F1EF627A7912');
        $this->addSql('ALTER TABLE actions DROP FOREIGN KEY FK_548F1EFC9CEB381');
        $this->addSql('DROP INDEX IDX_548F1EF627A7912 ON actions');
        $this->addSql('DROP INDEX IDX_548F1EFC9CEB381 ON actions');
        $this->addSql('ALTER TABLE actions DROP reutilisable_id, DROP consommable_id');
    }
}
