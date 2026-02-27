<?php

declare(strict_types=1);

namespace SchoolManagement\Domain\Ports;

interface TransactionalSession
{
    public function execute(callable $operation): void;
}