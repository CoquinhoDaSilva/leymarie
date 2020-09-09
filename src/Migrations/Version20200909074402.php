<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200909074402 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alert_message ADD altpicture VARCHAR(255) DEFAULT NULL, ADD titlepicture VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD altpicture VARCHAR(255) NOT NULL, ADD titlepicture VARCHAR(255) NOT NULL, CHANGE picture picture VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE category ADD altpicture VARCHAR(255) NOT NULL, ADD titlepicture VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE protocol ADD altpicture VARCHAR(255) NOT NULL, ADD titlepicture VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alert_message DROP altpicture, DROP titlepicture');
        $this->addSql('ALTER TABLE article DROP altpicture, DROP titlepicture, CHANGE picture picture VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE category DROP altpicture, DROP titlepicture');
        $this->addSql('ALTER TABLE protocol DROP altpicture, DROP titlepicture');
    }
}
