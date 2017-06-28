<?php if( is_single() && !is_user_logged_in() && !isBot() ):
    set_post_views();
endif; ?>
<div class="right-content">
	<ul>
		<li>
			<p>デイリーランキング</p>
		</li>
		<?php
			$args = array(
				'post_type'     => 'post',
				'numberposts'   => 3,       //表示数
				'meta_key'      => 'pv_count',
				'orderby'       => 'meta_value_num',
				'order'         => 'DESC',
			);
			$posts = get_posts( $args );
			if( $posts ):
		?>
		<?php
			foreach( $posts as $post ) : setup_postdata( $post );
		?>
			<li>
				<a href="<?php the_permalink(); ?>" >
					<div><?php the_post_thumbnail( 'thumbnail' ); ?></div>
				</a>
			</li>
		<?php
			endforeach;
			wp_reset_postdata();
		?>
		<?php else : ?>
			<p>アクセスランキングはまだ集計されていません。</p>
		<?php endif; ?>
	</ul>
</div>