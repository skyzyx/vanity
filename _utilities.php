<?php
class Util
{
	public static function access($o)
	{
		$accesses = array();

		if (method_exists($o, 'isFinal')) {
			if ($o->isFinal()) $accesses[] = 'final';
		}
		if (method_exists($o, 'isAbstract')) {
			if ($o->isAbstract()) $accesses[] = 'abstract';
		}
		if (method_exists($o, 'isPrivate')) {
			if ($o->isPrivate()) $accesses[] = 'private';
		}
		if (method_exists($o, 'isProtected')) {
			if ($o->isProtected()) $accesses[] = 'protected';
		}
		if (method_exists($o, 'isPublic')) {
			if ($o->isPublic()) $accesses[] = 'public';
		}
		if (method_exists($o, 'isStatic')) {
			if ($o->isStatic()) $accesses[] = 'static';
		}

		return $accesses;
	}

	public static function tagify($s)
	{
		$s = preg_replace("/[^A-Za-z0-9\s]/", '', $s);
		$s = ucwords($s);
		$s = str_replace(' ', '', $s);
		$s[0] = strtolower($s[0]);
		return $s;
	}

	public static function line_numbers($lnum, $content)
	{
		return str_pad($lnum + 1, strlen((string) sizeof($content)), '0', STR_PAD_LEFT);
	}

	public static function htmlize($data, $xml)
	{
		if (is_array($data))
		{
			foreach ($data as $d)
			{
				if (gettype($d) === 'string')
				{
					$line = $xml->addChild('line');
					$line->addCDATA($d);
				}
				else
				{
					$line = $xml->addChild('entry');
					foreach ($d as $k => $v)
					{
						$xk = $line->addChild($k);
						Util::htmlize($v, $xk);
					}
				}
			}
		}
		elseif (gettype($data) === 'string')
		{
			$xml->addCDATA($data);
		}

		return $xml;
	}

	public static function rglob($pattern, $flags = 0, $path = '')
	{
		if (!$path && ($dir = dirname($pattern)) != '.')
		{
			if ($dir == '\\' || $dir == '/')
			{
				$dir = '';
			}

			return Util::rglob(basename($pattern), $flags, $dir . '/');
		}

		$paths = glob($path . '*', GLOB_ONLYDIR | GLOB_NOSORT);
		$files = glob($path . $pattern, $flags);

		foreach ($paths as $p)
		{
			$files = array_merge($files, Util::rglob($pattern, $flags, $p . '/'));
		}

		return $files;
	}
}
