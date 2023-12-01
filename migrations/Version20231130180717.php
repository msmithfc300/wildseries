<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231130180717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, number INT NOT NULL, year INT NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE programme ADD season_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FF4EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('CREATE INDEX IDX_3DDCB9FF4EC001D1 ON programme (season_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FF4EC001D1');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP INDEX IDX_3DDCB9FF4EC001D1 ON programme');
        $this->addSql('ALTER TABLE programme DROP season_id');
    }
}
