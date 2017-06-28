<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
		<title><?php bloginfo('name'); ?></title>
	</head>
	<body>
		<?php get_header(); ?>
		<div class="content">
			<div class="main-content-top">
				<ul>
					<li>
						<a href="#">
							<img class="thumbnail" src="img/background.jpg">
						</a>
					</li>
					<li>
						<a href="#">
							<img class="thumbnail" src="img/background.jpg">
						</a>
					</li>
				</ul>
			</div>
			<div class="main-content">
				<ul>
					<?php
					if (have_posts()) :
						while (have_posts()) : the_post(); ?>
							<li>
								<a href="<?php the_permalink();?>">
									<?php if (has_post_thumbnail()) : ?>
										<?php
											$image_id = get_post_thumbnail_id ();
											$image_url = wp_get_attachment_image_src ($image_id, true);
										?>
										<img class="thumbnail-min" src="<?php echo $image_url[0]; ?>">
									<?php else : ?>
										<img src="<?php bloginfo('template_url'); ?>/img/noimage.gif" width="100" height="100" alt="デフォルト画像" /></a>
									<?php endif ; ?>
									<figcaption>
										<p><?php echo the_title(); ?></p>
									</figcaption>
								</a>
							</li>
						<?php endwhile;
					else : ?>
						<div class="post">
							<h2>記事はありません</h2>
							<p>お探しの記事は見つかりませんでした。</p>
						</div>
					<?php endif; ?>
				</ul>
			</div>
			<?php get_sidebar(); ?>
		</div>
		<?php get_footer(); ?>
	</body>
</html>