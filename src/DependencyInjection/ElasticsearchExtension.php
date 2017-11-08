<?php

declare(strict_types = 1);

namespace Mhujer\ElasticsearchBundle\DependencyInjection;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Mhujer\ElasticsearchBundle\ClientBuilderWrapper;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
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
		$clientDefinition->setFactory(ClientBuilderWrapper::class . '::buildClient');
		$clientDefinition->setArguments([
			new Reference('mhujer_elasticsearch_client_builder'),
		]);
		$container->setDefinition('mhujer_elasticsearch_client.default', $clientDefinition);

		$clientBuilderWrapperDefinition = new Definition(ClientBuilderWrapper::class);
		$container->setDefinition('mhujer_elasticsearch_client_builder_wrapper', $clientBuilderWrapperDefinition);

		$clientBuilderDefinition = new Definition(ClientBuilder::class);
		$clientBuilderDefinition->setShared(false); // probably
		$clientBuilderDefinition->setPublic(false);
		$clientBuilderDefinition->addMethodCall('setHosts', [$hosts]);
		//$clientBuilderDefinition->addMethodCall('setLogger', ['%elastic_hosts%']); // @monolog.logger.elasticsearch

		$container->setDefinition('mhujer_elasticsearch_client_builder', $clientBuilderDefinition);
	}

}
