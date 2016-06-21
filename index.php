<?php
	$ga = get_theme_mod( 'ga_setting' );
	$bback = get_theme_mod( 'back_setting' );
	$abt = get_theme_mod( 'abt_setting' );
	$donext = get_theme_mod( 'donext_setting' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
	<title>
		<?php if (is_home () ) { bloginfo('name'); echo ' | '; bloginfo('description'); } elseif ( is_category() ) { single_cat_title(); echo ' | by @mijustin';  } elseif (is_single() ) { single_post_title(); echo ' | by @mijustin'; } elseif (is_page() ) { single_post_title(); echo ' | by @mijustin'; } else { wp_title('',true); echo ' | by @mijustin'; } ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<link href="/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Author Info for Google -->
	<link href='https://plus.google.com/u/0/115056462967470089501' rel='author'/>
	<meta name="author" content="Justin Jackson">
	<link rel="canonical" href="http://justinjackson.ca">
	<?php if (is_home ()) { ?>
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<?php } elseif(is_single()) { ?>
		<meta name="description" content="<?php $excerpt = strip_tags(get_the_excerpt()); echo $excerpt; ?>">
	<?php } ?>

	<!-- Facebook Article Info -->
	<meta property="og:image" content="http://justinjackson.ca/apple-touch-icon.png">
	<meta property="og:title" content="Let's make some stuff">
	<meta property="og:site_name" content="Justin Jackson">
	<meta property="og:url" content="http://justinjackson.ca">
	<meta property="og:description" content="Justin Jackson is a product person from Vernon, BC, Canada">

	<!-- Twitter Info -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@mijustin">
	<meta name="twitter:creator" content="@mijustin">

	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo_rss('name'); ?>" href="<?php bloginfo_rss('atom_url') ?>">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php if ( !(is_single() || is_page()) ) { ?>
<header id="top" class="clearfix">
  <h2 id="hometop">
    <?php bloginfo('name'); ?>
  </h2>
  <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
</header>
<?php } ?>
<article<?php if(is_single()) { ?> class="red"<?php } ?>>
  <?php if(is_404()) { ?>
  <h2>Sorry, but nothing exists here.</h2>
  <p>Find something <a href="<?php echo home_url(); ?>">interesting to read</a>.</p>
  <?php } ?>
  <?php if(is_home()) { query_posts('posts_per_page=-1'); } while (have_posts()) : the_post(); ?>
  <?php if (is_page()) { ?>
  <small><strong>&#8592 <a href="<?php echo home_url(); ?>"><?php echo $back; ?></a></strong></small>
  <h2>
    <?php the_title(); ?>
  </h2>
  <p>
    <?php
						if ( has_post_thumbnail() )
						the_post_thumbnail( 'large' );
					?>
  </p>
  <?php the_content(); edit_post_link('edit', ' <span class="edit">', '</span>'); ?>
  <?php } elseif (is_single()) { ?>
  <small><strong>&#8592 <a href="<?php echo home_url(); ?>"><?php echo $back; ?></a></strong></small>
  <h2 class="red">
    <?php if(is_single() || is_page()) { the_title(); } else { ?>
    <a href="<?php the_permalink(); ?>">
    <?php the_title(); ?>
    </a>
    <?php } ?>
  </h2>
  <small>Written by <a href="/?page_id=<?php echo $abt; ?>">
  <?php the_author(); ?>
  </a> on
  <?php the_time('F j, Y'); ?>
  </small>
  <p>
    <?php
	if ( has_post_thumbnail() )
		the_post_thumbnail( 'large' );
?>
  </p>
  <?php the_content(); edit_post_link('edit', ' <span class="edit">', '</span>'); ?>
  <?php } else { ?>
  <h2 class="red">
    <?php if(is_single() || is_page()) { the_title(); } else { ?>
    <a href="<?php the_permalink(); ?>">
    <?php the_title(); ?>
    </a>
    <?php } ?>
  </h2>
  <?php } ?>
  <?php endwhile; ?>
</article>
<footer>
  <?php if(!is_home()) {?>
  <p>
    <?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
  </p>
  <p><strong><a href="<?php echo home_url(); ?>"><?php echo $bback; ?></a></strong></p>
  <?php } else { ?>
  <p>
    <?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
  </p>
  <?php } ?>
</footer>
<?php wp_footer(); ?>

<?php if ( ! is_preview() ) { ?>
<script> (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ga('create', '<?php echo $ga; ?>', '<?php echo home_url(); ?>'); ga('send', 'pageview'); </script>
<?php  } ?>
</body>
</html>
