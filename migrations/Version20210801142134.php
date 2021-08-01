<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210801142134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create `car` table and its relationships with `employee`';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE car (id CHAR(36) NOT NULL, owner_id CHAR(36) NOT NULL, brand VARCHAR(20) NOT NULL, model VARCHAR(50) NOT NULL, INDEX IDX_car_owner_id (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_car_owner_id FOREIGN KEY (owner_id) REFERENCES employee (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE car');
    }
}
