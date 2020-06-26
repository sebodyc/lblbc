<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200625174630 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE in_box (id INT AUTO_INCREMENT NOT NULL, destinataire_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, message VARCHAR(1000) NOT NULL, created_at DATETIME NOT NULL, sender VARCHAR(255) NOT NULL, product_user_id INT NOT NULL, INDEX IDX_DCBDB8C1A4F84F6E (destinataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(6555) NOT NULL, price DOUBLE PRECISION NOT NULL, zip_code INT NOT NULL, INDEX IDX_B3BA5A5AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE in_box ADD CONSTRAINT FK_DCBDB8C1A4F84F6E FOREIGN KEY (destinataire_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD zip_code INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE in_box');
        $this->addSql('DROP TABLE products');
        $this->addSql('ALTER TABLE user DROP zip_code');
    }
}
