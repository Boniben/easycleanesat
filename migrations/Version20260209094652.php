<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260209094652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervention ADD redacteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB764D0490 FOREIGN KEY (redacteur_id) REFERENCES redacteur (id)');
        $this->addSql('CREATE INDEX IDX_D11814AB764D0490 ON intervention (redacteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814AB764D0490');
        $this->addSql('DROP INDEX IDX_D11814AB764D0490 ON intervention');
        $this->addSql('ALTER TABLE intervention DROP redacteur_id');
    }
}
