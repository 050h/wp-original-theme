<?php $posts = get_posts(array(
	'posts_per_page' => 5,
	'meta_key' => 'views',
	'orderby' => 'meta_value_num',
)); ?>
<div class="right-content">
	<ul>
		<li>
			<p>デイリーランキング</p>
		</li>
		<?php foreach($posts as $post) : ?>
			<li>
				<a href="<?php the_permalink(); ?>" >
					<div><?php the_post_thumbnail( 'thumbnail' ); ?></div>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>