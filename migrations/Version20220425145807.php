<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220425145807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hotel (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, managedby_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, description CLOB NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3535ED9244413E0 ON hotel (managedby_id)');
        $this->addSql('CREATE TABLE room (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, hotel_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, descirption CLOB NOT NULL, price DOUBLE PRECISION NOT NULL, pictures VARCHAR(255) NOT NULL, lienbooking VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_729F519B3243BB18 ON room (hotel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE room');
    }
}
