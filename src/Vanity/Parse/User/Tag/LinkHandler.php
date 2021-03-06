<?php
/**
 * Copyright (c) 2009-2012 [Ryan Parman](http://ryanparman.com)
 * Copyright (c) 2011-2012 [Amazon Web Services, Inc.](http://aws.amazon.com)
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

use Vanity\Dictionary\Services;
use Vanity\Parse\User\Tag\HandlerInterface;
use Vanity\Parse\User\Tag\AbstractNameTypeDescription;

/**
 * The handler for @link tags.
 */
class LinkHandler extends AbstractNameTypeDescription implements HandlerInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function process($elongate = false)
	{
		$return = parent::process(false);

		if (isset($return['type']))
		{
			$return['uri'] = $return['type'];
			unset($return['type']);
		}

		if (isset($return['uri']))
		{
			// http://example.com
			if (preg_match('/^https?:/i', $return['uri']))
			{
				$return['uri_hint'] = 'url';

				if (!isset($return['description']))
				{
					$return['description'] = $return['uri'];
				}
			}

			// me@example.com
			elseif (preg_match('/[\w\._\-\+]+@[\w\._\-\+]+\./i', $return['uri']))
			{
				$return['uri_hint'] = 'mail';

				if (!isset($return['description']))
				{
					$return['description'] = $return['uri'];
				}
			}

			// service:user
			elseif (preg_match('/^(\w*)((:|@)(\/\/)?)(.*)$/', $return['uri'], $m) &&
			        $data = Services::get($m[1], $m[5]))
			{
				$return['uri_hint'] = 'url';
				$return['uri'] = $data['uri'];

				if (!isset($return['description']))
				{
					$return['description'] = $data['long'];
				}
			}
		}

		return $return;
	}
}
