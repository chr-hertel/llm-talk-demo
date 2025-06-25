<?php

declare(strict_types=1);

namespace App;

use PhpLlm\LlmChain\Chain\Toolbox\Attribute\AsTool;
use Symfony\Component\Clock\ClockInterface;

#[AsTool('clock', 'Get the current time')]
final readonly class Clock
{
    public function __construct(private ClockInterface $clock)
    {
    }

    public function __invoke(): string
    {
        return $this->clock
            ->withTimeZone('Europe/Berlin')
            ->now()->format('Y-m-d H:i:s');
    }
}
