<?php

use PhpLlm\LlmChain\Platform\Bridge\OpenAI\GPT;
use PhpLlm\LlmChain\Platform\Bridge\OpenAI\PlatformFactory;
use PhpLlm\LlmChain\Chain\Chain;
use PhpLlm\LlmChain\Platform\Message\Message;
use PhpLlm\LlmChain\Platform\Message\MessageBag;
use Symfony\Component\Dotenv\Dotenv;

require_once dirname(__DIR__).'/vendor/autoload.php';
(new Dotenv())->loadEnv(dirname(__DIR__).'/.env');
$apiKey = $_ENV['OPENAI_API_KEY'];

// EXAMPLE CODE FROM SLIDE BELOW

$platform = PlatformFactory::create($apiKey);
$chain = new Chain($platform, new GPT());

$messages = new MessageBag(
    Message::forSystem('You are a pirate and you write funny.'),
    Message::ofUser('What is the Symfony framework?'),
);

$response = $chain->call($messages);

echo $response->getContent();
