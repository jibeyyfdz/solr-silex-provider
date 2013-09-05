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
 * Default field-object for index-fields
 *
 * @author magdev
 */
class FieldObject implements FieldInterface
{
	/** @var string */
	protected $name;
	
	/** @var mixed */
	protected $value;
	
	/** @var float */
	protected $boost = 1.0;
	
	
	/**
	 * Constructor
	 *
	 * @param string $name
	 * @param string $value
	 * @param float $boost
	 */
	public function __construct($name, $value, $boost = 1.0)
	{
		$this->setName($name)
			->setValue($value)
			->setBoost($boost);
	}
	
	
	/**
	 * @see \ApacheSolr\Document\Field\FieldInterface::setName()
	 */
	public function setName($name)
	{
		$this->name = (string) $name;
		return $this;
	}
	
	
	/**
	 * @see \ApacheSolr\Document\Field\FieldInterface::setValue()
	 */
	public function setValue($value)
	{
		$this->value = $value;
		return $this;
	}
	
	
	/**
	 * @see \ApacheSolr\Document\Field\FieldInterface::setBoost()
	 */
	public function setBoost($boost)
	{
		$this->boost = round($boost, 1);
		return $this;
	}
	
	
	/**
	 * @see \ApacheSolr\Document\Field\FieldInterface::getName()
	 */
	public function getName()
	{
		return $this->name;
	}
	

	/**
	 * @see \ApacheSolr\Document\Field\FieldInterface::getValue()
	 */
	public function getValue()
	{
	    return $this->value;
	}
	

	/**
	 * @see \ApacheSolr\Document\Field\FieldInterface::getBoost()
	 */
	public function getBoost()
	{
	    return $this->boost;
	}
}