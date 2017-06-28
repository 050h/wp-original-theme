<?php
	ini_set( 'display_errors', 1 );
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
		<title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
	</head>
	<body>
		<?php get_header(); ?>
		<div class="content">
			<div class="main-content">
				<div class="article">
					<?php if (have_posts()) :
						while (have_posts()) : the_post(); ?>
							<?php 
								$image_id = get_post_thumbnail_id();
								$image_url = wp_get_attachment_image_src($image_id, true);
							?>
							<div class="article-header">
								<img src="<?php echo $image_url[0]; ?>">
								<a href="<?php the_permalink(); ?>"><h1><?php echo get_the_title(); ?></h1></a>
							</div>
							<div class="article-content">
								<?php the_content(); ?>
							</div>
						<?php endwhile;
					else : ?>
						<div class="post">
							<h2>記事はありません</h2>
							<p>お探しの記事は見つかりませんでした。</p>
						</div>
					<?php endif; ?>
				</div>
				<div class="postlinks">
					<?php if( get_previous_post() ): ?>
						<div class="prev"><?php previous_post_link('%link', '%title »'); ?></div>
					<?php endif;
					if( get_next_post() ): ?>
						<div class="next"><?php next_post_link('%link', '« %title'); ?></div>
					<?php endif; ?>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
		<?php get_footer(); ?>
	</body>
</html>