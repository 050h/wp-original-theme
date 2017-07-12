<header>
	<div class="title-box">
		<div class="logo">
			<a href="/"><h1><?php bloginfo('name'); ?></h1></a>
		</div>
	</div>
	<nav>
		<ul>
			<?php
				$categories = get_the_category();
				foreach ($categories as $category) {
					$catId = $category->cat_ID;
					$link = get_category_link($catId);
					echo '<li><a href="'.$link.'" title="'.$category->name.'">'.$category->name.'</a></li>';
				}
			?>
		</ul>
	</nav>
</header>