<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220311182840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artisty (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artisty_track (artisty_id INT NOT NULL, track_id INT NOT NULL, INDEX IDX_2B414E23B1DB063 (artisty_id), INDEX IDX_2B414E25ED23C43 (track_id), PRIMARY KEY(artisty_id, track_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE track (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, playcount INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artisty_track ADD CONSTRAINT FK_2B414E23B1DB063 FOREIGN KEY (artisty_id) REFERENCES artisty (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artisty_track ADD CONSTRAINT FK_2B414E25ED23C43 FOREIGN KEY (track_id) REFERENCES track (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artisty_track DROP FOREIGN KEY FK_2B414E23B1DB063');
        $this->addSql('ALTER TABLE artisty_track DROP FOREIGN KEY FK_2B414E25ED23C43');
        $this->addSql('DROP TABLE artisty');
        $this->addSql('DROP TABLE artisty_track');
        $this->addSql('DROP TABLE track');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
