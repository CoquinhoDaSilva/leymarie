<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200402143256 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article CHANGE user_id user_id INT DEFAULT NULL, CHANGE picture picture VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commentary CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE healthcare ADD price_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE healthcare ADD CONSTRAINT FK_1EBF6AAFD614C7E7 FOREIGN KEY (price_id) REFERENCES price (id)');
        $this->addSql('CREATE INDEX IDX_1EBF6AAFD614C7E7 ON healthcare (price_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article CHANGE user_id user_id INT DEFAULT NULL, CHANGE picture picture VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commentary CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE healthcare DROP FOREIGN KEY FK_1EBF6AAFD614C7E7');
        $this->addSql('DROP INDEX IDX_1EBF6AAFD614C7E7 ON healthcare');
        $this->addSql('ALTER TABLE healthcare DROP price_id');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
