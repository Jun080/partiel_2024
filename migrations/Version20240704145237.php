<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704145237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE resultat DROP FOREIGN KEY FK_E7DB5DE2A708DAFF');
        $this->addSql('DROP INDEX IDX_E7DB5DE2A708DAFF ON resultat');
        $this->addSql('ALTER TABLE resultat CHANGE election_id theme_id INT NOT NULL');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE259027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('CREATE INDEX IDX_E7DB5DE259027487 ON resultat (theme_id)');
        $this->addSql('ALTER TABLE theme CHANGE propositions propositions JSON DEFAULT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE resultat DROP FOREIGN KEY FK_E7DB5DE259027487');
        $this->addSql('DROP INDEX IDX_E7DB5DE259027487 ON resultat');
        $this->addSql('ALTER TABLE resultat CHANGE theme_id election_id INT NOT NULL');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE2A708DAFF FOREIGN KEY (election_id) REFERENCES theme (id)');
        $this->addSql('CREATE INDEX IDX_E7DB5DE2A708DAFF ON resultat (election_id)');
        $this->addSql('ALTER TABLE theme CHANGE propositions propositions JSON NOT NULL COMMENT \'(DC2Type:json)\'');
    }
}
