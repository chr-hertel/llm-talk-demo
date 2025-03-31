<?php

declare(strict_types=1);

namespace App\Command;

use PhpLlm\LlmChain\ChainInterface;
use PhpLlm\LlmChain\Model\Message\Message;
use PhpLlm\LlmChain\Model\Message\MessageBag;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('app:chat')]
final readonly class ChatCommand
{
    public function __construct(
        private ChainInterface $chain,
    ) {
    }

    public function __invoke(SymfonyStyle $io): int
    {
        $io->title('Chat with GPT');
        $messages = new MessageBag();

        while ('bye' !== $userMessage = $io->ask('You')) {
            $messages->add(Message::ofUser($userMessage));

            $response = $this->chain->call($messages)->getContent();

            $io->writeln(' <comment>Bot</comment>:');
            $io->writeln(' > '.$response);

            $messages->add(Message::ofAssistant($response));
        };

        $io->success('Goodbye!');

        return Command::SUCCESS;
    }
}
