<?php

declare(strict_types=1);

namespace SchoolManagement\Infrastructure\Persistence\InMemory;

use SchoolManagement\Domain\Ports\TransactionalSession;

final class InMemoryTransactionalSession implements TransactionalSession
{
    public function execute(callable $operation): void
    {
        $operation();
    }
}