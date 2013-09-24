<?php
/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2013 Marco Graetsch <magdev3.0@googlemail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author    magdev
 * @copyright 2013 Marco Graetsch <magdev3.0@googlemail.com>
 * @package
 * @license   http://opensource.org/licenses/MIT MIT License
 */


namespace ApacheSolr\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use ApacheSolr\Service\IndexerService;
use ApacheSolr\Service\SearchService;
use ApacheSolr\Service\ServerManagerService;

/**
 * Silex service provider to integrate magdev/php-assimp library.
 *
 * @author magdev
 */
class ApacheSolrProvider implements ServiceProviderInterface
{
    public function boot(Application $app)
    {
    	
    }

    public function register(Application $app)
    {
    	if (!isset($app['solr.local'])) {
    		$app['solr.local'] = array();
    	}
        $app['solr.search'] = $app->share(function(Application $app) {
        	return new SearchService($app['solr.options']);
        });
        
        $app['solr.indexer'] = $app->share(function(Application $app) {
        	$indexer = new IndexerService($app['solr.options']);
        	$indexer->setSearch($app['solr.search']);
        	return $indexer;
        });
        	
        $app['solr.server_manager'] = $app->share(function(Application $app) {
        	return new ServerManagerService($app['solr.options'], $app['solr.local']);
        });
    }
}