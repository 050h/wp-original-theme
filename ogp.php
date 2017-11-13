<meta property='og:locale' content='ja_JP'>
<meta property='fb:admins' content='CjyTcAuvt3O'><!--アカウントのAdmins ID-->
<meta property='article:publisher' content='http://facebook.com/reizou05' /><!--FacebookページのURL-->
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@reizou05" />
<meta name="twitter:player" content="@reizou05" />
<?php if(is_single()){ // 投稿記事 ?>
	<meta property='og:type' content='article'>
	<meta property='og:title' content='<?php the_title() ?>'>
	<meta property='og:url' content='<?php the_permalink() ?>'>
	<meta property='og:description' content='<?php echo mb_substr(get_the_excerpt(), 0, 100) ?>'>
<?php } else { //ホーム・カテゴリー・固定ページなど ?>
	<meta property='og:type' content='website'>
	<meta property='og:title' content='<?php bloginfo('name') ?>'>
	<meta property='og:url' content='<?php bloginfo('url') ?>'>
	<meta property='og:description' content='<?php bloginfo( 'description' ); ?>'>
<? } ?>
<meta property='og:site_name' content='<?php bloginfo('name'); ?>'>
<?php
	if (is_single() or is_page()){//投稿記事か固定ページ
		if (has_post_thumbnail()){//アイキャッチがある場合
			$image_id = get_post_thumbnail_id();
			$image = wp_get_attachment_image_src($image_id, 'full');
			echo '<meta property="og:image" content="'.$image[0].'">';echo "\n";
		} elseif( preg_match( '/<img.*?src=(["\'])(.+?)\1.*?>/i', $post->post_content, $imgurl ) && !is_archive()) {
			//アイキャッチ以外の画像がある場合
			echo '<meta property="og:image" content="'.$imgurl[2].'">';echo "\n";
		} else {//画像が1つも無い場合
			echo '<meta property="og:image" content="http://reizou05.com/img/reizou05.jpg">';echo "\n"; //画像が1つも無い場合に表示する画像URL
		}
	} else { //ホーム・カテゴリーページなど
		echo '<meta property="og:image" content="http://reizou05.com/img/reizou05.jpg">';echo "\n"; //画像が1つも無い場合に表示する画像URL
	}
?>