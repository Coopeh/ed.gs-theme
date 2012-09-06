<!DOCTYPE html>
<!--[if lt IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie6 lte7 lte8 lte9"><![endif]-->
<!--[if IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie7 lte7 lte8 lte9"><![endif]-->
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="no-js ie ie8 lte8 lte9"><![endif]-->
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="no-js ie ie9 lte9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php wp_title(); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="shortcut icon" href="<?= get_template_directory_uri() ?>/favicon.ico" />
<?php

		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
?>

<?php add_action( 'wp_enqueue_scripts', 'main_css' );  ?>
<?php wp_head(); ?>
<link rel="shortcut icon" href="<?= get_template_directory_uri() ?>/favicon.ico" />
<?php $options = get_option ( 'svbtle_options' ); ?>
<?php echo $options['google_analytics'];?>
<?php if(isset($options['color'])){
	$color = $options['color'];
}else {
	$color = '#ff0000';
}?>


<style type="text/css" media="screen">
	.links a:hover, article .entry-content blockquote {border-color: <?php echo $color ?>}
	a.back-to-blog{ color: <?php echo $color ?>; border-color: <?php echo $color ?>;}
	a.back-to-blog:hover,  section#cover,figure#user_logo div.logo{background-color: <?php echo $color ?>;}
</style>


	<script src="<?= get_template_directory_uri() ?>/js/html5.js" async></script>

	</head>
	<body <?php body_class(); ?>>

	<div id="wrap">

		<header role="banner" class="bounce">

		 	<figure id="user_logo">
			    <a href="<?php echo site_url(); ?>">
			      <div class="logo">&nbsp;</div>
			    </a>
			  </figure>

			<p class="subtitle"><?php bloginfo( 'description' ); ?></p>

			<?php
			ob_start();
			get_option('home');
			$site_url = ob_get_clean();
			?>

			<div class="links">
				<?php
					$mypages = get_pages( array( 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );

					foreach( $mypages as $page ) {
						$content = $page->post_content;
						if ( ! $content ) // Check for empty page
							continue;

						$content = apply_filters( 'the_content', $content );
					?>
						<p><a href="<?php echo get_page_link( $page->ID ); ?>"><?php echo $page->post_title; ?></a></p>
					<?php
					}
				?>
				<?php if (isset($options['twitter_username'])): ?>
					<p><a target="_blank" href="http://twitter.com/<?php echo $options['twitter_username'] ?>">@<?php echo $options['twitter_username'] ?></a></p>
				<?php endif ?>
				<?php if (get_option('admin_email')): ?>
					<p><a href=mailto:"<?php echo get_option('admin_email') ?>">say hello</a></p>
				<?php endif ?>
				<p><a href="<?php bloginfo('rss2_url'); ?>">rss feed</a></p>
				<div class="icon_container">
					<div class="icon">
						<img src="<?php echo get_template_directory_uri(); ?>/images/icon.png" alt="" />
						<div class="popup">
							<ul>
								<li class="loading">Loading...</li>
							</ul>
						</div>
					</div>
				</div>
				<?php if (is_user_logged_in()) { ?>
				<p><a href="/wp-admin/post-new.php">new post</a></p>
				<?php } ?>
				<?php if (is_user_logged_in()) {
					if (is_single()) { ?>
				<p><?php echo edit_post_link('edit post'); ?></p>
				<?php 	}
				}
				 ?>
			</div><!-- .links -->
		</header>

		<section id="content" role="main">


