# Silex Service-Provider for Apache Solr

##Installation

Add it using [Composer](http://getcomposer.org/) :

```json
{
    "require": {
        "magdev/solr-silex-provider": "dev-master"
    }
}
```

and until this package is registered at [Packagist](https://packagist.org/) add the repository

```json
{
    "repositories" : [{
            "type" : "vcs",
            "url" : "git@github.com:jibeyyfdz/solr-silex-provider.git"
        }
    ]
}
```

##Usage

###Registering the provider

```php
use Silex\Application;
use ApacheSolr\Silex\Provider\ApacheSolrProvider;

$app = new Application();
$app['solr.options'] = array (
    'hostname' => 'localhost',
    'port' => 8983,
    'secure' => false,
    'username' => null,
    'password' => null,
    'timeout' => 10,
    'ssl_cert' => null,
    'ssl_cert_only' => null,
    'ssl_key' => null,
    'ssl_keypassword' => null,
    'ssl_cainfo' => null,
    'ssl_capath' => null,
);
$app->register(new ApacheSolrProvider());
```

##License

This is released under the MIT license