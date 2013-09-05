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


namespace ApacheSolr\Document\Field;


/**
 * Interface for document-fields
 *
 * @author magdev
 */
interface FieldInterface
{
	/**
	 * Get the name of the field
	 *
	 * @return string
	 */
	public function getName();
	
	
	/**
	 * Get the value of the field
	 *
	 * @return string
	 */
	public function getValue();
	
	
	/**
	 * Get the boost for the field
	 *
	 * @return float
	 */
	public function getBoost();
	
	
	/**
	 * Set the name of the field
	 *
	 * @param string $name
	 * @return \ApacheSolr\Document\Field\FieldInterface
	 */
	public function setName($name);
	
	
	/**
	 * Set the value of the field
	 *
	 * @param mixed $value
	 * @return \ApacheSolr\Document\Field\FieldInterface
	 */
	public function setValue($value);
	
	
	/**
	 * Set the boost for the field
	 *
	 * @param float $boost
	 * @return \ApacheSolr\Document\Field\FieldInterface
	 */
	public function setBoost($boost);
}