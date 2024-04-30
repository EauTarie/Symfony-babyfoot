<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240430074648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE team_game (id INT AUTO_INCREMENT NOT NULL, first_team_id INT NOT NULL, second_team_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_F2CAC5F73AE0B452 (first_team_id), INDEX IDX_F2CAC5F73E2E58C3 (second_team_id), INDEX IDX_F2CAC5F7E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE team_game ADD CONSTRAINT FK_F2CAC5F73AE0B452 FOREIGN KEY (first_team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE team_game ADD CONSTRAINT FK_F2CAC5F73E2E58C3 FOREIGN KEY (second_team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE team_game ADD CONSTRAINT FK_F2CAC5F7E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C3E2E58C3');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CF7F171DE');
        $this->addSql('DROP INDEX UNIQ_232B318C3E2E58C3 ON game');
        $this->addSql('DROP INDEX UNIQ_232B318CF7F171DE ON game');
        $this->addSql('ALTER TABLE game DROP id_team_id, DROP second_team_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team_game DROP FOREIGN KEY FK_F2CAC5F73AE0B452');
        $this->addSql('ALTER TABLE team_game DROP FOREIGN KEY FK_F2CAC5F73E2E58C3');
        $this->addSql('ALTER TABLE team_game DROP FOREIGN KEY FK_F2CAC5F7E48FD905');
        $this->addSql('DROP TABLE team_game');
        $this->addSql('ALTER TABLE game ADD id_team_id INT NOT NULL, ADD second_team_id INT NOT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C3E2E58C3 FOREIGN KEY (second_team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CF7F171DE FOREIGN KEY (id_team_id) REFERENCES team (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_232B318C3E2E58C3 ON game (second_team_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_232B318CF7F171DE ON game (id_team_id)');
    }
}
