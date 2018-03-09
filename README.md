# env-providers-bundle
Some extra env providers to make using Symfony 3+ .env files not such a pain

## Introduction

\<rant type="personal"\>I much prefer the old parameters.yml way of doing things as it was more flexible, but Symfony has decided to move to dotenv, so...\</rant\>
This bundle adds in 'missing' ways to parse dotenv variables so that you can not hate it so much.

## Installation

You know the score:

```bash
composer require c0ntax/env-providers-bundle
```

And don't forget to add the following to your Kernel if you're not using Flex:

```php
    public function registerBundles()
    {
        $bundles = [
            // ...
            new C0ntax\EnvProvidersBundle\C0ntaxEnvProvidersBundle(),
            // ...
        ];
    }
```

## Configuration

Currently, a little configuration-light, you can add the following:

```yaml
c0ntax_env_providers:
    array:
        return_null_if_empty: true # If the env variable = '' then return a null instead of an empty array
```

## Usage

In your .env file

```dotenv
ENV_VAR=this,that, other
```

and then in your configuration

```yaml
parameters:
    array_thing: '%env(array:ENV_VAR)%'
```

Err, that's it. `array_thing` now equals `['this', 'that', 'other']`
