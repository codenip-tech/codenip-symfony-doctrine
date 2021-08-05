<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210805214808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `user.score`';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user ADD score INT NOT NULL DEFAULT 0');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user DROP score');
    }
}
