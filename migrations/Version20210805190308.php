<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210805190308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create `phone` and `user_phone` tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE phone (id CHAR(36) NOT NULL, number VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_phone (user_id CHAR(36) NOT NULL, phone_id CHAR(36) NOT NULL, INDEX IDX_user_phone_user_id (user_id), UNIQUE INDEX U_user_phone_phone_id (phone_id), PRIMARY KEY(user_id, phone_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_phone ADD CONSTRAINT FK_user_phone_user_id FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_phone ADD CONSTRAINT FK_user_phone_phone_id FOREIGN KEY (phone_id) REFERENCES phone (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user_phone DROP FOREIGN KEY FK_user_phone_user_id');
        $this->addSql('ALTER TABLE user_phone DROP FOREIGN KEY FK_user_phone_phone_id');
        $this->addSql('DROP TABLE phone');
        $this->addSql('DROP TABLE user_phone');
    }
}
