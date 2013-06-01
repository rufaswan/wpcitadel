<?php
/*
Template Name: Sitemap
*/
include ($ccache['base_path'] . '/div-title.php');
include ($ccache['base_path'] . '/div-header.php');
?>

<?php
if ( $citadel_locked ) :
	include ($ccache['base_path'] . '/div-countdown.php');
else :
?>
<div id='main-wrapper' class='singlephp singlepage'>
<section id='content'>
	<article id='sitemap'>

	<?php
	$elements = $citadel->explode(',', $citadel_options['sitemap']);

	if ( $elements )
	{
		foreach ( $elements as $el )
		{
			switch($el)
			{
				case "posts-by-alpha":
					echo "<section id='".$el."'><h1>Posts</h1><ul>";
					wp_get_archives('type=alpha');
					echo "</ul></section>\n";
				break;

				case "posts-by-date":
					echo "<section id='".$el."'><h1>Posts</h1><ul>";
					wp_get_archives('type=postbypost');
					echo "</ul></section>\n";
				break;

				case "pages":
					echo "<section id='".$el."'><h1>Pages</h1><ul>";
					wp_list_pages('title_li=');
					echo "</ul></section>\n";
				break;

				case "categories":
					echo "<section id='".$el."'><h1>Categories</h1><ul>";
					wp_list_categories('title_li=');
					echo "</ul></section>\n";
				break;

				case "tags":
					echo "<section id='".$el."'><h1>Tags</h1>";
					wp_tag_cloud('format=list&smallest=1&largest=1&unit=em&number=0');
					echo "</section>\n";
				break;

				case "authors":
					echo "<section id='".$el."'><h1>Authors</h1><ul>";
					wp_list_authors('title_li=');
					echo "</ul></section>\n";
				break;

				case "archives_monthly":
					echo "<section id='".$el."'><h1>Monthly Archives</h1><ul>";
					wp_get_archives('type=monthly');
					echo "</ul></section>\n";
				break;

				case "archives_yearly":
					echo "<section id='".$el."'><h1>Yearly Archives</h1><ul>";
					wp_get_archives('type=yearly');
					echo "</ul></section>\n";
				break;

				case "archives_daily":
					echo "<section id='".$el."'><h1>Daily Archives</h1><ul>";
					wp_get_archives('type=daily');
					echo "</ul></section>\n";
				break;

				case "archives_weekly":
					echo "<section id='".$el."'><h1>Weekly Archives</h1><ul>";
					wp_get_archives('type=weekly');
					echo "</ul></section>\n";
				break;

				case "bookmarks":
					echo "<section id='".$el."'><h1>Bookmarks</h1><ul>";
					wp_list_bookmarks('title_before=&title_after=');
					echo "</ul></section>\n";
				break;

			}
			echo "<p class='entry-utility'><a href='#'>Return to top</a></p>\n";
		}
	}
	?>

	</article>

</section>
</div>
<?php endif; ?>

<?php
include ($ccache['base_path'] . '/div-footer.php');
?>
