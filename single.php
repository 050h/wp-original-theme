<!DOCTYPE html>
<html lang="ja_JP">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/base.css">
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/common.css">
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/single.css">
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/header.css">
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/footer.css">	
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.css">

		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>

		<?php require('ogp.php'); ?>

		<title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
	</head>
	<body>
		<?php get_header(); ?>
		<section id="article">
			<div class="content">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="side-contents">
					<div class="side-content">
						<p>Date</p>
						<p class="date"><?php echo get_the_date("Y.m.d"); ?></p>
						<p>Category</p>
						<p class="cats">
							<?php
								$categories = get_the_category();
								if($categories){
									foreach($categories as $category){
										echo '<a href="'.get_category_link($category->term_id).'">'.$category->cat_name.'</a>,';
									}
								}
							?>
						</p>
						<p>Tags</p>
						<?php
							the_tags('<p class="tags"><span class="tag">','</span><span class="tag">','</span></p>');
						?>
					</div>
				</div>
				<div class="article-content">
					<h1><?php the_title(); ?></h1>
					<?php the_post_thumbnail(); ?>
					<?php the_content(); ?>
					<div class="share-btns">
						<a href="http://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>&via=reizou05" data-lang="ja" class="twitter" onclick="window.open(this.href, 'tweetwindow', 'width=650, height=470, personalbar=0, toolbar=0, scrollbars=1, sizable=1'); return false;">
							<img src="<?php echo get_template_directory_uri(); ?>/img/sns-icon/twitter.png">
						</a>
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="facebook" onclick="window.open(this.href, 'tweetwindow', 'width=650, height=470, personalbar=0, toolbar=0, scrollbars=1, sizable=1'); return false;">
							<img src="<?php echo get_template_directory_uri(); ?>/img/sns-icon/facebook.png">
						</a>
						<a href="http://line.naver.jp/R/msg/text/?<?php the_title(); ?>%0D%0A<?php the_permalink(); ?>" target="_blank" class="line">
							<img src="<?php echo get_template_directory_uri(); ?>/img/sns-icon/line.png">
						</a>
						<a href="http://b.hatena.ne.jp/entry/<?php the_permalink(); ?>" target="_blank" class="hatebu">
							<img src="<?php echo get_template_directory_uri(); ?>/img/sns-icon/hatebu.png">
						</a>
					</div>
				</div>
			</div>
			<?php endwhile; else : ?>
			<div class="article-content">
				<h1>404</h1>
				<p>記事がありません</p>
			</div>
			<?php endif; ?>
		</section>
		<section id="relateds">
			<div class="content">
				<h2 class="section-title">RELATED POSTS</h2>
				<div class="pins">
				<?php
					$args = ['posts_per_page' => 3];
					$myposts = get_posts($args);
					foreach ($myposts as $post) : setup_postdata($post); ?>
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
				<?php
					endforeach; wp_reset_postdata();
				?>
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
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</section>
		<?php get_template_part('bottom'); ?>
		<?php get_footer(); ?>
	</body>
</html>