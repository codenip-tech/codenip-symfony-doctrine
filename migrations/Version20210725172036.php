<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210725172036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create `profile` table and its relationships with `user`';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE profile (id CHAR(36) NOT NULL, user_id CHAR(36) NOT NULL, picture_url VARCHAR(250) DEFAULT NULL, UNIQUE INDEX U_profile_user_id (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_profile_user_id FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE profile');
    }
}
