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


use dflydev\markdown\MarkdownExtraParser as Markdown;
use Vanity\Generate\Utilities as GenerateUtils;

/**
 * Twig function for converting descriptions into HTML format.
 *
 * @internal
 * @param  array  $d The description node to convert.
 * @return string    The description converted to HTML.
 */
function vanity_twig_description_as_html(array $d)
{
	return GenerateUtils::descriptionAsHTML($d);
}

/**
 * Twig function for determining the path that would be represented by the namespace.
 *
 * @param  string $fullName The full classname (including namespace).
 * @return string           The path that would be represented by the fully-qualified class name.
 */
function vanity_twig_namespace_as_path($fullName)
{
	return GenerateUtils::namespaceAsPath($fullName);
}

/**
 * Twig function for filtering a list of nodes by whether or not they're native.
 *
 * @param  array $list An array of methods for the class.
 * @return array       A `count` key and a `methods` key. The `methods` key is a list of methods.
 */
function vanity_twig_filter_by_native(array $list)
{
	$output = GenerateUtils::getFilteredList($list);
	return $output['native'];
}

/**
 * Twig function for filtering a list of nodes by whether or not they're native.
 *
 * @param  array $list An array of methods for the class.
 * @return array       A `count` key and a `methods` key. The `methods` key is a list of methods.
 */
function vanity_twig_filter_by_inherited(array $list)
{
	$output = GenerateUtils::getFilteredList($list);
	return $output['inherited'];
}

/**
 * Twig function for filtering a list of nodes by first letter.
 *
 * @param  array $list An array of methods for the class.
 * @return array       A list of nodes sorted by letter.
 */
function vanity_twig_filter_by_letter(array $list)
{
	return GenerateUtils::getListByLetter($list);
}

/**
 * Twig function for filtering a list down to simple names.
 *
 * @param  array $list The list of methods from the JSON model.
 * @return array       An array containing matching nodes.
 */
function vanity_twig_names(array $list)
{
	return GenerateUtils::getNames($list);
}

/**
 * Apply Markdown to a string.
 * @param  string $string A Markdown-formatted string.
 * @return string         An HTML representation of the Markdown-formatted string.
 */
function vanity_twig_markdown($string)
{
	$md = new Markdown();
	return $md->transformMarkdown($string);
}
