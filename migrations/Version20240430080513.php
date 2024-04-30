<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240430080513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team_game DROP FOREIGN KEY FK_F2CAC5F7E48FD905');
        $this->addSql('ALTER TABLE team_game DROP FOREIGN KEY FK_F2CAC5F73AE0B452');
        $this->addSql('ALTER TABLE team_game DROP FOREIGN KEY FK_F2CAC5F73E2E58C3');
        $this->addSql('DROP TABLE team_game');
        $this->addSql('ALTER TABLE game ADD first_team_id INT NOT NULL, ADD second_team_id INT NOT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C3AE0B452 FOREIGN KEY (first_team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C3E2E58C3 FOREIGN KEY (second_team_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_232B318C3AE0B452 ON game (first_team_id)');
        $this->addSql('CREATE INDEX IDX_232B318C3E2E58C3 ON game (second_team_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE team_game (id INT AUTO_INCREMENT NOT NULL, first_team_id INT NOT NULL, second_team_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_F2CAC5F73AE0B452 (first_team_id), INDEX IDX_F2CAC5F73E2E58C3 (second_team_id), INDEX IDX_F2CAC5F7E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE team_game ADD CONSTRAINT FK_F2CAC5F7E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE team_game ADD CONSTRAINT FK_F2CAC5F73AE0B452 FOREIGN KEY (first_team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE team_game ADD CONSTRAINT FK_F2CAC5F73E2E58C3 FOREIGN KEY (second_team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C3AE0B452');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C3E2E58C3');
        $this->addSql('DROP INDEX IDX_232B318C3AE0B452 ON game');
        $this->addSql('DROP INDEX IDX_232B318C3E2E58C3 ON game');
        $this->addSql('ALTER TABLE game DROP first_team_id, DROP second_team_id');
    }
}
