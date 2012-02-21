<?php
/**
 * Copyright (c) 2009-2012 [Ryan Parman](http://ryanparman.com)
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

namespace Vanity\Event
{
	use Symfony\Component\EventDispatcher\Event,
	    Symfony\Component\Console\Input\InputInterface,
	    Symfony\Component\Console\Output\OutputInterface;

	/**
	 * Extends <Symfony\Component\EventDispatcher\Event> with explicit support
	 * for storing the inputs and outputs.
	 */
	class InputOutput extends Event
	{
		/**
		 * Stores the console Input object.
		 */
		private $input;

		/**
		 * Stores the console Output object.
		 */
		private $output;

		/**
		 * Constructs a new instance of <Vanity\Event\InputOutput>.
		 *
		 * @param InputInterface  $input  A <Symfony\Component\Console\Input\InputInterface> object.
		 * @param OutputInterface $output A <Symfony\Component\Console\Output\OutputInterface> object.
		 * @return void
		 */
		public function __construct(InputInterface $input, OutputInterface $output)
		{
			$this->input = $input;
			$this->output = $output;
		}

		/**
		 * Get the Input object.
		 */
		public function get_input()
		{
			return $this->input;
		}

		/**
		 * Get the Output object.
		 */
		public function get_output()
		{
			return $this->output;
		}
	}
}
