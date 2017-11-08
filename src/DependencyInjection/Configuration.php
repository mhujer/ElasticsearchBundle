<?php

declare(strict_types = 1);

namespace Mhujer\ElasticsearchBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

	public function getConfigTreeBuilder(): TreeBuilder
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root('elasticsearch');

		// @codingStandardsIgnoreStart tree is indented for better readability
		$rootNode
			->children()
				->arrayNode('client')
					->isRequired()
					->children()
						->arrayNode('default')
						->isRequired()
							->children()
								->arrayNode('hosts')
									->isRequired()
									->requiresAtLeastOneElement()
									->prototype('scalar')->isRequired(true)->end()
						->end() // default
				->end() // client
			->end();
		// @codingStandardsIgnoreEnd

		return $treeBuilder;
	}

}
