<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240504142935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE person_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE person (id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE payment ADD payment_capture_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D5EC69251 FOREIGN KEY (payment_capture_id) REFERENCES payment_capture (payment_capture_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D28840D5EC69251 ON payment (payment_capture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE person_id_seq CASCADE');
        $this->addSql('DROP TABLE person');
        $this->addSql('ALTER TABLE payment DROP CONSTRAINT FK_6D28840D5EC69251');
        $this->addSql('DROP INDEX UNIQ_6D28840D5EC69251');
        $this->addSql('ALTER TABLE payment DROP payment_capture_id');
    }
}
