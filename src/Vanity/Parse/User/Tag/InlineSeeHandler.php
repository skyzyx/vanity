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


namespace Vanity\Parse\User\Tag;

use Vanity\Console\Utilities as ConsoleUtil;
use Vanity\Parse\User\Tag\HandlerInterface;
use Vanity\Parse\User\Tag\AbstractNameTypeDescription;
use Vanity\System\DocumentationInconsistencyCollector as Inconsistency;
use Vanity\System\Store as SystemStore;

/**
 * The handler for {@see} tags.
 */
class InlineSeeHandler
{
	/**
	 * {@inheritdoc}
	 */
	public function __construct($description, AncestryHandler $ancestry)
	{
		$this->description = $description;
		$this->ancestry = $ancestry;
	}

	/**
	 * {@inheritdoc}
	 */
	public function process($elongate = false)
	{
		$pattern = '/
			^[\s]*                     # Preceding whitespace
			(?:
				([\w\|_\\\\]+)         # Type, if exists
				[\s]+
			)?
			(?:
				[\w_]+\(\)[\s]+        # Method, if exists
			)?
			([\w\|_\\\\]+)             # Method name (with parameters)
			\(
				(
					.*?
					(?:
						(\()(.*?\))*   # Method arguments that may contain nested arrays
					)?
				)
			\)
			[\s]*
			(.*)                       # Description
		/ux';

		$pattern = '/
			\{
				[\s]*
				\@see
				[\s]+
				(
					.*?
					(?:
						(\()(.*?\))*   # Method arguments that may contain nested arrays
					)?
				)
		/ux';


		if (preg_match($pattern, $content, $m))
		{
print_r($m);
		}
	}
}
