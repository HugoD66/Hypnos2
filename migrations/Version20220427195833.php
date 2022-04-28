<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220427195833 extends AbstractMigration
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
        $this->addSql('ALTER TABLE user ADD COLUMN picture VARCHAR(255) DEFAULT NULL');
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
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, password, is_verified, name, lastname FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, name VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, roles, password, is_verified, name, lastname) SELECT id, email, roles, password, is_verified, name, lastname FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }
}
