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

use ApacheSolr\Document\DocumentInterface;

/**
 * Apache Solr indexer service
 *
 * @author magdev
 */
class IndexerService extends AbstractService
{
	/** @var ApacheSolr\Service\SearchService */
	protected $search = null;

	
	/**
	 * Set the search client
	 *
	 * @param \ApacheSolr\Service\SearchService $search
	 * @return \ApacheSolr\Service\IndexerService
	 */
	public function setSearch(SearchService $search)
	{
		$this->search = $search;
		return $this;
	}
	
	
	/**
	 * Get the search client
	 *
	 * Creates a new SearchService object if none is set
	 *
	 * @return \ApacheSolr\Service\SearchService
	 */
	protected function getSearch()
	{
		if (!$this->search) {
			$this->search = new SearchService($this->getOptions());
		}
		return $this->search;
	}
	
	
	/**
	 * Index a document
	 *
	 * @param \ApacheSolr\Document\DocumentInterface $document
	 * @return \SolrUpdateResponse
	 */
	public function index(DocumentInterface $document)
	{
		$doc = new \SolrInputDocument();
		$doc->setBoost($document->getBoost());
		
		foreach ($document->getIndexFields() as $field) {
			/* @var $field \ApacheSolr\Document\Field\FieldInterface */
			$doc->addField($field->getName(), $field->getValue(), $field->getBoost());
		}
		
		return $this->getClient()->addDocument($doc);
	}
	
	
	/**
	 * Flush the entire index
	 *
	 * @return \ApacheSolr\Service\IndexerService
	 */
	public function flush()
	{
		$this->getClient()->deleteByQuery('*:*');
		$this->getClient()->commit();
		return $this;
	}
}