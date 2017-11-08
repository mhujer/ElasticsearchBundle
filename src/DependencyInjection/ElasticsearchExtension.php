<?php

declare(strict_types = 1);

namespace Mhujer\ElasticsearchBundle\DependencyInjection;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class ElasticsearchExtension extends ConfigurableExtension
{

	/**
	 * @param mixed[][] $mergedConfig
	 * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
	 */
	protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
	{
		$hosts = $mergedConfig['client']['default']['hosts'];

		$clientDefinition = new Definition(Client::class);
		$clientDefinition->setFactory(ClientBuilder::class . '::build');
		$container->setDefinition('mhujer_elasticsearch_client.default', $clientDefinition);

		$clientBuilderDefinition = new Definition(ClientBuilder::class);
		$clientBuilderDefinition->setPublic(false);
		$clientBuilderDefinition->addMethodCall('setHosts', [$hosts]);
		//$clientBuilderDefinition->addMethodCall('setLogger', ['%elastic_hosts%']); // @monolog.logger.elasticsearch

		$container->setDefinition('mhujer_elasticsearch_client_builder', $clientBuilderDefinition);
	}

}
