<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200902133403 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE healthcare ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE healthcare ADD CONSTRAINT FK_1EBF6AAF12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_1EBF6AAF12469DE2 ON healthcare (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE healthcare DROP FOREIGN KEY FK_1EBF6AAF12469DE2');
        $this->addSql('DROP INDEX IDX_1EBF6AAF12469DE2 ON healthcare');
        $this->addSql('ALTER TABLE healthcare DROP category_id');
    }
}
