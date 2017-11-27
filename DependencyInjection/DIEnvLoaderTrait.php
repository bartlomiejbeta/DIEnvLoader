<?php
/**
 * Created by PhpStorm.
 * User: bartb
 * Date: 11/27/17
 * Time: 12:17
 */

//@formatter:off
declare(strict_types=1);
//@formatter:on

namespace BartB\DIEnvLoaderBundle\DependencyInjection;


use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

trait DIEnvLoaderTrait
{
	public static function loadByEnv(FileLoader $fileLoader, ContainerBuilder $container, string $name, string $extension, string $delimiter = '-')
	{
		$env              = self::getEnv($container);
		$preparedFileName = sprintf('%s%s%s.%s', $name, $delimiter, $env, $extension);
		$locator          = $fileLoader->getLocator();

		$locator->locate($preparedFileName);

		$fileLoader->load($preparedFileName);
	}

	public static function getEnv(ContainerBuilder $container): string
	{
		$env = $container->getParameter("kernel.environment");

		return $env;
	}
}