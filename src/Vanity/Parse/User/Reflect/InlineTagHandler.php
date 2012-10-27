<?php
/**
 * Copyright (c) 2009-2012 [Ryan Parman](http://ryanparman.com)
 * Copyright (c) 2011-2012 [Amazon Web Services, LLC](http://aws.amazon.com)
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
 * <http://www.opensource.org/licenses/mit-license.php>
 */


namespace Vanity\Parse\User\Reflect;

use Vanity\Config\Store as ConfigStore;
use Vanity\Parse\User\Reflect\AncestryHandler;
use Vanity\Parse\User\Tag;
use Vanity\Parse\User\Tag\InlineInternalHandler;
use Vanity\Parse\User\Tag\InlineSeeHandler;

/**
 * Handle inline tags for a description.
 *
 * @author Ryan Parman <http://ryanparman.com>
 * @link   http://vanitydoc.org
 */
class InlineTagHandler
{
	/**
	 * Storage for the description.
	 * @type string
	 */
	protected $description;

	/**
	 * Storage for ancestry.
	 * @type AncestryHandler
	 */
	public $ancestry;

	/**
	 * Constructs a new instance of this class.
	 *
	 * @param string          $description The description to work with.
	 * @param AncestryHandler $ancestry The ancestry data for the class.
	 */
	public function __construct($description, AncestryHandler $ancestry)
	{
		$resolve = ConfigStore::get('api.resolve_aliases');

		$inlineTag = new InlineInternalHandler($description, $ancestry);
		$description = $inlineTag->process($resolve);

		// $inlineTag = new InlineSeeHandler($description, $ancestry);
		// $description = $inlineTag->process($resolve);

		$this->description = $description;
	}

	/**
	 * Get the description.
	 *
	 * @return string The description with the inline tags parsed.
	 */
	public function getDescription()
	{
		return $this->description;
	}
}
