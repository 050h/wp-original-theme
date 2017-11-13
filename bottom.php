<section id="bottom">
	<div class="content">
		<div class="left-content">
			<p class="box-title">PROFILE</p>
			<img src="<?php echo get_template_directory_uri(); ?>/img/reizou05.jpg">
			<p class="prof-content">
				<a href="http://twitter.com/reizou05" target="_blank">@reizou05</a><br>
				日本の高校生で趣味は筋トレ<br>
				<a href="http://tento.tech" target="_blank">tento.tech</a>という学生プログラマー集団の長をやっています。<br>
				WEB系のお仕事をください。
			</p>
		</div>
		<div class="right-content">
			<p class="box-title">CATEGORY</p>
			<div class="categories">
				<?php
					$categories = get_categories(['hide_empty' => 0]);
					if($categories){
						foreach($categories as $category){
							echo '<a href="'.get_category_link($category->term_id).'">'.$category->cat_name.'</a>';
						}
					}
				?>
			</div>
		</div>
		<div class="left-content">
			<p class="box-title">AD</p>
			<?php get_template_part('adlink'); ?>
		</div>
	</div>
</section>