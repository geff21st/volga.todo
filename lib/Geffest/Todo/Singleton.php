<?php

namespace Geffest\Todo;


trait Singleton
{
	protected static $instance = null;

	public static function getInstance()
	{
		if (is_null(self::$instance))
			self::$instance = new static();
		return self::$instance;
	}
}