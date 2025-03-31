# LLM Talk Demos

## Setup

```bash
git clone git@github.com:chr-hertel/llm-talk-demo.git
cd llm-talk-demo
composer install
symfony serve -d
echo "OPENAI_API_KEY=sk-..." > .env.local
```

## Run demos
```base
# Plain LLM Chain Demo
php bin/example.php

# Bundle Integration
php bin/console app:example
php bin/console app:chat --profile
```

## Missing Code:

`bin/example.php`:
```php
$platform = PlatformFactory::create($apiKey);
$chain = new Chain($platform, new GPT());

$messages = new MessageBag(
    Message::forSystem('You are a pirate and you write funny.'),
    Message::ofUser('What is the Symfony framework?'),
);

$response = $chain->call($messages);

echo $response->getContent();
```

`src/Command/ExampleCommand.php`:
```php
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
```

`src/Clock.php`:
```php
use PhpLlm\LlmChain\Chain\Toolbox\Attribute\AsTool;
use Symfony\Component\Clock\ClockInterface;

#[AsTool('clock', description: 'Returns the current date and time.')]
final readonly class Clock
{
    public function __construct(private ClockInterface $clock)
    {
    }

    public function __invoke(): string
    {
        return $this->clock->now()->format('Y-m-d H:i:s');
    }
}
```
