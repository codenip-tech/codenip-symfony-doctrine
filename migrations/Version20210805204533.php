<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210805204533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create `friends` table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE friends (user_id CHAR(36) NOT NULL, friend_user_id CHAR(36) NOT NULL, INDEX IDX_friends_user_id (user_id), INDEX IDX_friends_friend_user_id (friend_user_id), PRIMARY KEY(user_id, friend_user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE friends ADD CONSTRAINT FK_friends_user_id FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE friends ADD CONSTRAINT FK_friends_friend_user_id FOREIGN KEY (friend_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE friends');
    }
}
