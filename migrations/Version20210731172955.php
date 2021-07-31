<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210731172955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create `employee` table and its relationships';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE employee (id CHAR(36) NOT NULL, manager_id CHAR(36) DEFAULT NULL, name VARCHAR(20) NOT NULL, UNIQUE INDEX U_employee_manager_id (manager_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_employee_manager_id FOREIGN KEY (manager_id) REFERENCES employee (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_employee_manager_id');
        $this->addSql('DROP TABLE employee');
    }
}
