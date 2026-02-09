<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260209095639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contenant ADD unite_volume_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contenant ADD CONSTRAINT FK_AE3E49A1B292AAF FOREIGN KEY (unite_volume_id) REFERENCES unite_volume (id)');
        $this->addSql('CREATE INDEX IDX_AE3E49A1B292AAF ON contenant (unite_volume_id)');
        $this->addSql('ALTER TABLE meo_produit ADD produit_id INT DEFAULT NULL, ADD contenant_id INT DEFAULT NULL, ADD unite_volume_id INT DEFAULT NULL, ADD moyen_dosage_id INT DEFAULT NULL, ADD temps_contact_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE meo_produit ADD CONSTRAINT FK_7C1C39A1F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE meo_produit ADD CONSTRAINT FK_7C1C39A15E211B2E FOREIGN KEY (contenant_id) REFERENCES contenant (id)');
        $this->addSql('ALTER TABLE meo_produit ADD CONSTRAINT FK_7C1C39A1B292AAF FOREIGN KEY (unite_volume_id) REFERENCES unite_volume (id)');
        $this->addSql('ALTER TABLE meo_produit ADD CONSTRAINT FK_7C1C39A1DC01C6E0 FOREIGN KEY (moyen_dosage_id) REFERENCES moyen_dosage (id)');
        $this->addSql('ALTER TABLE meo_produit ADD CONSTRAINT FK_7C1C39A1AB3FFB8F FOREIGN KEY (temps_contact_id) REFERENCES temps_contact (id)');
        $this->addSql('CREATE INDEX IDX_7C1C39A1F347EFB ON meo_produit (produit_id)');
        $this->addSql('CREATE INDEX IDX_7C1C39A15E211B2E ON meo_produit (contenant_id)');
        $this->addSql('CREATE INDEX IDX_7C1C39A1B292AAF ON meo_produit (unite_volume_id)');
        $this->addSql('CREATE INDEX IDX_7C1C39A1DC01C6E0 ON meo_produit (moyen_dosage_id)');
        $this->addSql('CREATE INDEX IDX_7C1C39A1AB3FFB8F ON meo_produit (temps_contact_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contenant DROP FOREIGN KEY FK_AE3E49A1B292AAF');
        $this->addSql('DROP INDEX IDX_AE3E49A1B292AAF ON contenant');
        $this->addSql('ALTER TABLE contenant DROP unite_volume_id');
        $this->addSql('ALTER TABLE meo_produit DROP FOREIGN KEY FK_7C1C39A1F347EFB');
        $this->addSql('ALTER TABLE meo_produit DROP FOREIGN KEY FK_7C1C39A15E211B2E');
        $this->addSql('ALTER TABLE meo_produit DROP FOREIGN KEY FK_7C1C39A1B292AAF');
        $this->addSql('ALTER TABLE meo_produit DROP FOREIGN KEY FK_7C1C39A1DC01C6E0');
        $this->addSql('ALTER TABLE meo_produit DROP FOREIGN KEY FK_7C1C39A1AB3FFB8F');
        $this->addSql('DROP INDEX IDX_7C1C39A1F347EFB ON meo_produit');
        $this->addSql('DROP INDEX IDX_7C1C39A15E211B2E ON meo_produit');
        $this->addSql('DROP INDEX IDX_7C1C39A1B292AAF ON meo_produit');
        $this->addSql('DROP INDEX IDX_7C1C39A1DC01C6E0 ON meo_produit');
        $this->addSql('DROP INDEX IDX_7C1C39A1AB3FFB8F ON meo_produit');
        $this->addSql('ALTER TABLE meo_produit DROP produit_id, DROP contenant_id, DROP unite_volume_id, DROP moyen_dosage_id, DROP temps_contact_id');
    }
}
