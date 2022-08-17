<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220816203231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76166D1F9C');
        $this->addSql('DROP INDEX IDX_D8698A76166D1F9C ON document');
        $this->addSql('ALTER TABLE document DROP project_id');
        $this->addSql('ALTER TABLE invoice ADD project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_90651744166D1F9C ON invoice (project_id)');
        $this->addSql('ALTER TABLE quote ADD project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF4166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_6B71CBF4166D1F9C ON quote (project_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document ADD project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_D8698A76166D1F9C ON document (project_id)');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744166D1F9C');
        $this->addSql('DROP INDEX IDX_90651744166D1F9C ON invoice');
        $this->addSql('ALTER TABLE invoice DROP project_id');
        $this->addSql('ALTER TABLE quote DROP FOREIGN KEY FK_6B71CBF4166D1F9C');
        $this->addSql('DROP INDEX IDX_6B71CBF4166D1F9C ON quote');
        $this->addSql('ALTER TABLE quote DROP project_id');
    }
}
