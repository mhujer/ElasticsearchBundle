<?php

declare(strict_types = 1);

namespace Mhujer\ElasticsearchBundle;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class ClientBuilderWrapper
{

	public static function buildClient(
		ClientBuilder $clientBuilder
	): Client
	{
		return $clientBuilder->build();
	}

}
