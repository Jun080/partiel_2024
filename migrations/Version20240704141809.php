<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704141809 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bulletin (id INT AUTO_INCREMENT NOT NULL, proposition_id INT NOT NULL, vote_id INT NOT NULL, rang INT NOT NULL, INDEX IDX_2B7D8942DB96F9E (proposition_id), INDEX IDX_2B7D894272DCDAFC (vote_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE electeur (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(100) NOT NULL, mot_de_passe VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposition (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resultat (id INT AUTO_INCREMENT NOT NULL, theme_id INT NOT NULL, position INT NOT NULL, nombre_de_vote INT NOT NULL, INDEX IDX_E7DB5DE259027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, theme VARCHAR(100) NOT NULL, nombre_places_gagnants INT NOT NULL, propositions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vote (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bulletin ADD CONSTRAINT FK_2B7D8942DB96F9E FOREIGN KEY (proposition_id) REFERENCES proposition (id)');
        $this->addSql('ALTER TABLE bulletin ADD CONSTRAINT FK_2B7D894272DCDAFC FOREIGN KEY (vote_id) REFERENCES vote (id)');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE259027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bulletin DROP FOREIGN KEY FK_2B7D8942DB96F9E');
        $this->addSql('ALTER TABLE bulletin DROP FOREIGN KEY FK_2B7D894272DCDAFC');
        $this->addSql('ALTER TABLE resultat DROP FOREIGN KEY FK_E7DB5DE259027487');
        $this->addSql('DROP TABLE bulletin');
        $this->addSql('DROP TABLE electeur');
        $this->addSql('DROP TABLE proposition');
        $this->addSql('DROP TABLE resultat');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE vote');
    }
}
