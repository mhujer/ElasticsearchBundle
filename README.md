# ElasticsearchBundle
[![Build Status](https://travis-ci.org/mhujer/ElasticsearchBundle.svg?branch=master)](https://travis-ci.org/mhujer/ElasticsearchBundle)  [![Coverage Status](https://coveralls.io/repos/github/mhujer/ElasticsearchBundle/badge.svg?branch=master)](https://coveralls.io/github/mhujer/ElasticsearchBundle?branch=master) [![Latest Stable Version](https://poser.pugx.org/mhujer/ElasticsearchBundle/v/stable)](https://packagist.org/packages/mhujer/ElasticsearchBundle) [![License](https://poser.pugx.org/mhujer/ElasticsearchBundle/license)](https://packagist.org/packages/mhujer/ElasticsearchBundle)

@todo


Usage
----
1. Install the latest version with `composer require mhujer/elasticsearch-bundle`
2. Register the Bundle in the `AppKernel.php`:

```php
<?php

class AppKernel extends \Symfony\Component\HttpKernel\Kernel
{

	...

	public function registerBundles()
	{
		$bundles = [
			...
			new \Mhujer\ElasticsearchBundle\ElasticsearchBundle(),
		];

	}

```

Configuration
-------
The Bundle is automatically enabled only in `dev` mode (by using `kernel.debug` configuration parameter).

You can configure it manually by adding this to your `config.yml`:

```yaml
@todo
```


Requirements
------------
PHP 7.1/7.2 and Symfony 3.3+.


Author
------
[Martin Hujer](https://www.martinhujer.cz) 
