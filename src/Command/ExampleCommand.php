<?php

declare(strict_types=1);

namespace App\Command;

use PhpLlm\LlmChain\ChainInterface;
use PhpLlm\LlmChain\Model\Message\Message;
use PhpLlm\LlmChain\Model\Message\MessageBag;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('app:example')]
final readonly class ExampleCommand
{
    public function __construct(
        private ChainInterface $chain,
    ) {
    }

    public function __invoke(OutputInterface $output): int
    {
        $messages = new MessageBag(Message::ofUser('What is the Symfony framework?'));

        $response = $this->chain->call($messages);

        $output->writeln($response->getContent());

        return Command::SUCCESS;
    }
}
