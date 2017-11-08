<?php

declare(strict_types = 1);

namespace Mhujer\ElasticsearchBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class ElasticsearchExtension extends ConfigurableExtension
{

	/**
	 * Configures the passed container according to the merged configuration.
	 *
	 * @param array $mergedConfig
	 * @param ContainerBuilder $container
	 */
	protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
	{
		$hosts = $mergedConfig['client']['default']['hosts'];

		$clientDefinition = new Definition(\Elasticsearch\Client::class);
		$clientDefinition->setFactory('Elasticsearch\ClientBuilder::build');

		$clientBuilderDefinition = new Definition(\Elasticsearch\ClientBuilder::class);
		$clientBuilderDefinition->setPublic(false);
		$clientBuilderDefinition->addMethodCall('setHosts', [$hosts]);
		//$clientBuilderDefinition->addMethodCall('setLogger', ['%elastic_hosts%']); // @monolog.logger.elasticsearch

		$container->addDefinitions([
				'mhujer_elasticsearch_client.default' => $clientDefinition,
				'mhujer_elasticsearch_client_builder' => $clientBuilderDefinition,
			]
		);
	}
}
