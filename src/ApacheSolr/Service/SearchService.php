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
 * Apache Solr search service
 *
 * @author magdev
 */
class SearchService extends AbstractService
{
	/**
	 * Perform a query
	 *
	 * @param string|\SolrQuery $query
	 * @param int $start
	 * @param int $limit
	 * @return \SolrQueryResponse
	 */
	public function query($query, $start = 0, $limit = 50, array $fields = array())
	{
		if (!$query instanceof \SolrQuery) {
			$q = new \SolrQuery();
			$q->setQuery((string) $query);
			$query = $q;
		}
		/* @var $query \SolrQuery */
		$query->setStart((int) $start)
			->setRows((int) $limit);
		if (sizeof($fields)) {
			foreach ($fields as $field) {
				$query->addField($field);
			}
		}
		
		$response = $this->getClient()->query($query);
		$response->setParseMode(\SolrQueryResponse::PARSE_SOLR_DOC);
		return $response;
	}
	
	
	/**
	 * Get keyword suggestions
	 *
	 * @param string $query
	 * @param int $start
	 * @param int $limit
	 * @param string $field
	 * @param int $minFrequency
	 * @return \SolrQueryResponse
	 */
	public function suggestions($query, $limit = 10, $field = 'text', $minFrequency = 2)
	{
		$q = new \SolrQuery();
		$q->setTerms(true)
			->setTermsLimit((int) $limit)
			->setTermsPrefix((string) $query)
			->setTermsMinCount((int) $minFrequency)
			->setTermsField($field);
		
		$response = $this->getClient()->query($query);
		$response->setParseMode(\SolrQueryResponse::PARSE_SOLR_OBJ);
		return $response;
	}
	
	
	/**
	 * Get a single document
	 *
	 * @param int $id
	 * @return \SolrDocument
	 */
	public function getDocument($id)
	{
		$result = $this->query('id:'.$id, 0, 1)->getResponse();
		if (isset($result['docs']) && isset($result['docs'][0])) {
			return $result['docs'][0];
		}
		return null;
	}
}