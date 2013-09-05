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


namespace ApacheSolr\Service;

use Silex\Application;
use Silex\Application;


/**
 * Abstract Service for ApacheSolr
 *
 * @author magdev
 */
abstract class AbstractService
{
	/** @var array */
	protected $options = array();
	
	/** @var \SolrClient */
	protected $client;
	
	
	
	/**
	 * Constructor
	 *
	 * @param array $options
	 */
	public function __construct(array $options = null)
	{
		if (is_array($options)) {
			$this->setOptions($options);
		}
	}
	
	
	/**
	 * Set a specific option
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return \ApacheSolr\Service\AbstractService
	 */
	public function setOption($key, $value)
	{
		$this->options[$key] = $value;
		return $this;
	}
	
	
	/**
	 * Get a specific option
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function getOption($key)
	{
		if (isset($this->options[$key])) {
			return $this->options[$key];
		}
		return null;
	}
	
	
	/**
	 * Set multiple options
	 *
	 * @param array $options
	 * @return \ApacheSolr\Service\AbstractService
	 */
	public function setOptions(array $options)
	{
		foreach ($options as $key => $value) {
			$this->setOption($key, $value);
		}
		return $this;
	}
	
	
	/**
	 * Get the options
	 *
	 * @return array
	 */
	public function getOptions()
	{
		return $this->options;
	}
	
	
	/**
	 * Get the Solr client
	 *
	 * @return \SolrClient
	 */
	public function getClient()
	{
		if (!$this->client) {
			$this->client = new \SolrClient($this->getOptions());
		}
		return $this->client;
	}
}