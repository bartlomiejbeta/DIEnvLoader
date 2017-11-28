# DIEnvLoaderBundle

Easily load kernel environment dependent config files.

## instalation
```
composer require bartlomiejbeta/di-env-loader-bundle
```

## usage

### simple
```PHP
class ExampleExtension extends Extension
{
  use DIEnvLoaderTrait;

  public function load(array $configs, ContainerBuilder $container)
  {
    $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
    
    self::loadByEnv($loader, $container, 'services', 'yml');
  }

}
```
configs will be load for all kernel environments.
- for example for `test` environment file `services-test.yml` located in `Resources/config` (and so on for other environment)

### configured
```PHP
class ExampleExtension extends Extension
{
  use DIEnvLoaderTrait;

  public function load(array $configs, ContainerBuilder $container)
  {
    $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config/test'));
    
    if ('test' === self::getEnv($container))
    {
      self::loadByEnv($loader, $container, 'services', 'yml', '.');
    }
  }

}
```
configs will be load only for `test` kernel environment.

- file `services.test.yml` located in `Resources/config/test`
