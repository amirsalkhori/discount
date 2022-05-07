<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220507132824 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE discount_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE discount_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE wallet_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE discount (id INT NOT NULL, name VARCHAR(255) NOT NULL, start_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, end_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, discount_type VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, amount DOUBLE PRECISION NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, limite INT DEFAULT NULL, status BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E1E0B40E125C5293 ON discount (discount_type)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E1E0B40E77153098 ON discount (code)');
        $this->addSql('CREATE TABLE discount_user (id INT NOT NULL, users_id INT NOT NULL, discount_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1311D3F367B3B43D ON discount_user (users_id)');
        $this->addSql('CREATE INDEX IDX_1311D3F34C7C611F ON discount_user (discount_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6496B01BC5B ON "user" (phone_number)');
        $this->addSql('CREATE TABLE wallet (id INT NOT NULL, owner_id INT DEFAULT NULL, amount VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7C68921F7E3C61F9 ON wallet (owner_id)');
        $this->addSql('ALTER TABLE discount_user ADD CONSTRAINT FK_1311D3F367B3B43D FOREIGN KEY (users_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE discount_user ADD CONSTRAINT FK_1311D3F34C7C611F FOREIGN KEY (discount_id) REFERENCES discount (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wallet ADD CONSTRAINT FK_7C68921F7E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE discount_user DROP CONSTRAINT FK_1311D3F34C7C611F');
        $this->addSql('ALTER TABLE discount_user DROP CONSTRAINT FK_1311D3F367B3B43D');
        $this->addSql('ALTER TABLE wallet DROP CONSTRAINT FK_7C68921F7E3C61F9');
        $this->addSql('DROP SEQUENCE discount_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE discount_user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE wallet_id_seq CASCADE');
        $this->addSql('DROP TABLE discount');
        $this->addSql('DROP TABLE discount_user');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE wallet');
    }
}
