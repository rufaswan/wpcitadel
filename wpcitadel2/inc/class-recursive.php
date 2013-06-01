<?php defined('ABSPATH') or die('No direct script access.');

class citadel_recursive
{
	private $list;
	function citadel_recursive()	{ $this->list = array(); }
	function reset_list()			{ $this->list = array(); }
	function get_list()				{ return $this->list; }
	function sub_perms( $int )		{ return substr( decoct($int), -3); }

	function rm( $dir )
	{
		$dir = rtrim($dir, '/');
		clearstatcache();
		if ( is_dir($dir) )
		{
			$files = scandir($dir);
			foreach ( $files as $k => $f )
				( $f == '..' || $f == '.' ) ? '' : $this->rm( $dir. '/' .$f );

			$this->list[$dir] = ( rmdir($dir) ) ? TRUE : FALSE;
		}
		else
			$this->list[$dir] = ( unlink($dir) ) ? TRUE : FALSE;
	}

	function fmtime( $dir )
	{
		$dir = rtrim($dir, '/');
		clearstatcache();
		$this->list[$dir] = filemtime($dir);
		if ( is_dir($dir) )
		{
			if ( is_readable($dir) )
			{
				$files = scandir($dir);
				foreach ( $files as $k => $f )
					( $f == '..' || $f == '.' ) ? '' : $this->fmtime( $dir. '/' .$f );
			}
			else
				$this->list[$dir] = 'error';
		}
	}

	function fperm( $dir )
	{
		$dir = rtrim($dir, '/');
		clearstatcache();
		if ( is_dir($dir) )
		{
			if ( is_readable($dir) )
			{
				$files = scandir($dir);
				foreach ( $files as $k => $f )
					( $f == '..' || $f == '.' ) ? '' : $this->fperm( $dir. '/' .$f );
				$this->list['dir'][$dir] = fileperms($dir);
			}
			else
				$this->list['dir'][$dir] = 'error';
		}
		else
			$this->list['file'][$dir] = fileperms($dir);
	}
}
