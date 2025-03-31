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
