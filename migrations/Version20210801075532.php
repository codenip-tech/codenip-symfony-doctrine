<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210801075532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create `country` table and its relationship with `user`';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE country (id CHAR(36) NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD country_id CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_user_country_id FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_user_country_id ON user (country_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_user_country_id');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP INDEX IDX_user_country_id ON user');
        $this->addSql('ALTER TABLE user DROP country_id');
    }
}
