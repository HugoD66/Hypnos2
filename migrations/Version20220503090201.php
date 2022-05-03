<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503090201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_3535ED9244413E0');
        $this->addSql('CREATE TEMPORARY TABLE __temp__hotel AS SELECT id, managedby_id, name, adress, description FROM hotel');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('CREATE TABLE hotel (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, managedby_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, description CLOB NOT NULL, CONSTRAINT FK_3535ED9244413E0 FOREIGN KEY (managedby_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO hotel (id, managedby_id, name, adress, description) SELECT id, managedby_id, name, adress, description FROM __temp__hotel');
        $this->addSql('DROP TABLE __temp__hotel');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3535ED9244413E0 ON hotel (managedby_id)');
        $this->addSql('DROP INDEX IDX_729F519B3243BB18');
        $this->addSql('CREATE TEMPORARY TABLE __temp__room AS SELECT id, hotel_id, title, picture, descirption, price, pictures, lienbooking FROM room');
        $this->addSql('DROP TABLE room');
        $this->addSql('CREATE TABLE room (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, hotel_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, descirption CLOB NOT NULL, price DOUBLE PRECISION NOT NULL, pictures VARCHAR(255) NOT NULL, lienbooking VARCHAR(255) NOT NULL, CONSTRAINT FK_729F519B3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO room (id, hotel_id, title, picture, descirption, price, pictures, lienbooking) SELECT id, hotel_id, title, picture, descirption, price, pictures, lienbooking FROM __temp__room');
        $this->addSql('DROP TABLE __temp__room');
        $this->addSql('CREATE INDEX IDX_729F519B3243BB18 ON room (hotel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_3535ED9244413E0');
        $this->addSql('CREATE TEMPORARY TABLE __temp__hotel AS SELECT id, managedby_id, name, adress, description FROM hotel');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('CREATE TABLE hotel (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, managedby_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, description CLOB NOT NULL)');
        $this->addSql('INSERT INTO hotel (id, managedby_id, name, adress, description) SELECT id, managedby_id, name, adress, description FROM __temp__hotel');
        $this->addSql('DROP TABLE __temp__hotel');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3535ED9244413E0 ON hotel (managedby_id)');
        $this->addSql('DROP INDEX IDX_729F519B3243BB18');
        $this->addSql('CREATE TEMPORARY TABLE __temp__room AS SELECT id, hotel_id, title, picture, descirption, price, pictures, lienbooking FROM room');
        $this->addSql('DROP TABLE room');
        $this->addSql('CREATE TABLE room (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, hotel_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, descirption CLOB NOT NULL, price DOUBLE PRECISION NOT NULL, pictures VARCHAR(255) NOT NULL, lienbooking VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO room (id, hotel_id, title, picture, descirption, price, pictures, lienbooking) SELECT id, hotel_id, title, picture, descirption, price, pictures, lienbooking FROM __temp__room');
        $this->addSql('DROP TABLE __temp__room');
        $this->addSql('CREATE INDEX IDX_729F519B3243BB18 ON room (hotel_id)');
    }
}
