<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231211110059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actor_programme (actor_id INT NOT NULL, programme_id INT NOT NULL, INDEX IDX_C9A549D310DAF24A (actor_id), INDEX IDX_C9A549D362BB7AEE (programme_id), PRIMARY KEY(actor_id, programme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actor_programme ADD CONSTRAINT FK_C9A549D310DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actor_programme ADD CONSTRAINT FK_C9A549D362BB7AEE FOREIGN KEY (programme_id) REFERENCES programme (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actor_programme DROP FOREIGN KEY FK_C9A549D310DAF24A');
        $this->addSql('ALTER TABLE actor_programme DROP FOREIGN KEY FK_C9A549D362BB7AEE');
        $this->addSql('DROP TABLE actor');
        $this->addSql('DROP TABLE actor_programme');
    }
}
