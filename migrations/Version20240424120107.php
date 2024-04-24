<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240424120107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game ADD vip_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CAA4E6FD FOREIGN KEY (vip_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_232B318CAA4E6FD ON game (vip_id)');
        $this->addSql('ALTER TABLE team ADD slogan VARCHAR(75) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CAA4E6FD');
        $this->addSql('DROP INDEX IDX_232B318CAA4E6FD ON game');
        $this->addSql('ALTER TABLE game DROP vip_id');
        $this->addSql('ALTER TABLE team DROP slogan');
    }
}
