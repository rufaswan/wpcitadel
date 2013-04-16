<?php defined('TEMPLATEPATH') or die('No direct script access.');

class citadel_share
{
	private $title;
	private $url;
	private $img;

	function citadel_share()
	{
		global $ccache;
		$this->title	= urlencode( get_the_title() );
		$this->url		= urlencode( get_permalink() );
		$this->img		= $ccache['template_url'] . "/img";
	}

	function facebook()
	{
		$href = "https://www.facebook.com/sharer/sharer.php?u=" .$this->url. "&amp;t=" .$this->title;
		$src = $this->img . "/facebook.png";
		echo "<a href='".$href."' rel='nofollow'><img src='".$src."' alt='facebook' width='48' height='48' /></a>\n";
	}

	function googleplus()
	{
		$href = "https://plus.google.com/share?url=" .$this->url;
		$src = $this->img . "/googleplus.png";
		echo "<a href='".$href."' rel='nofollow'><img src='".$src."' alt='googleplus' width='48' height='48' /></a>\n";
	}

	function twitter()
	{
		$href = "https://twitter.com/intent/tweet?url=" .$this->url. "&amp;text=" .$this->title;
		$src = $this->img . "/twitter.png";
		echo "<a href='".$href."' rel='nofollow'><img src='".$src."' alt='twitter' width='48' height='48' /></a>\n";
	}
}
