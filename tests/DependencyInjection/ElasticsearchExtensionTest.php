<?php

declare(strict_types = 1);

namespace Mhujer\ElasticsearchBundle\DependencyInjection;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;

class ElasticsearchExtensionTest extends AbstractExtensionTestCase
{

	protected function getContainerExtensions()
	{
		return [
			new ElasticsearchExtension(),
		];
	}

	public function testListenerIsRegisteredInDebugMode(): void
	{
		$this->load([
			'client' => [
				'default' => [
					'hosts' => [
						'localhost:9200',
					],
				],
			],
		]);

		$this->assertContainerBuilderHasService('mhujer_elasticsearch_client.default', Client::class);

		$this->assertContainerBuilderHasService('mhujer_elasticsearch_client_builder', ClientBuilder::class);
		$this->assertContainerBuilderHasServiceDefinitionWithMethodCall(
			'mhujer_elasticsearch_client_builder',
			'setHosts',
			[
				[
					'localhost:9200',
				],
			]
		);
	}

}
