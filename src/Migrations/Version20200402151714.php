<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200402151714 extends AbstractMigration
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
        $this->addSql('ALTER TABLE healthcare CHANGE price_id price_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD firstname VARCHAR(50) NOT NULL, ADD name VARCHAR(50) NOT NULL, ADD phone VARCHAR(50) DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article CHANGE user_id user_id INT DEFAULT NULL, CHANGE picture picture VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commentary CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE healthcare CHANGE price_id price_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP firstname, DROP name, DROP phone, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
