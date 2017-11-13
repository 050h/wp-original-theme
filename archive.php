<!DOCTYPE html>
<html lang="ja_JP">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/base.css">
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/common.css">
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/index.css">
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/header.css">
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/footer.css">	
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.css">

		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>

		<?php require('ogp.php'); ?>

		<title><?php bloginfo('name'); ?></title>
	</head>
	<body>
		<?php get_header(); ?>
		<section id="articles">
			<div class="content">
				<h2 class="section-title"><?php single_cat_title(); ?></h2>
				<div class="pins">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="pin">
						<div class="circle-thumb">
							<a href="<?php the_permalink(); ?>">
								<img src="<?php echo get_the_post_thumbnail_url(); ?>">
							</a>
						</div>
						<div class="title-box">
							<p class="date"><?php echo get_the_date("Y.m.d"); ?></p>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<div class="tags">
							<?php
								$categories = get_the_category();
								if($categories){
									foreach($categories as $category){
										echo '<a href="'.get_category_link($category->term_id).'">'.$category->cat_name.'</a>,';
									}
								}
							?>
							</div>
						</div>
					</div>
				<?php endwhile; endif;?>
					<!-- <div class="pin">
						<div class="circle-thumb">
							<a href="#">
								<img src="../img/reizou05.jpg">
							</a>
						</div>
						<div class="title-box">
							<p class="date">2017.10.10</p>
							<a href="#">タイトルタイトルタイトルタイトル</a>
							<div class="tags">
								<a href="#" class="tag">プログラミング</a>
								<a href="#" class="tag">CSS</a>
							</div>
						</div>
					</div> -->
				</div>
				<?php
					if (function_exists("pagination")) {
						pagination($additional_loop->max_num_pages);
					}
				?>
				<!-- <div class="pagination">
					<span>1</span>
					<span><a href="#">2</a></span>
					<span><a href="#">3</a></span>
				</div> -->
			</div>
		</section>
		<?php get_template_part('bottom'); ?>
		<?php get_footer(); ?>
	</body>
</html>