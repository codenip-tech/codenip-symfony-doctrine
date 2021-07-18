<?php

declare(strict_types=1);

namespace App\Repository;

abstract class RedisBaseRepository
{
    protected function saveEntity(object $entity): void
    {
        // some logic
    }
}
