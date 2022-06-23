<?php

use gentechtree\streamlab\Helper;
use gentechtree\streamlab\Options;

$current_post = get_post_type();
Helper::update_post_views(get_the_ID());
global $video;
?>
<article <?php post_class(); ?>>
	<?php
	$terms = get_the_terms(get_the_ID(), 'video_cat');
	if (is_array($terms) && count($terms)) {
		$firstTerm = array_shift($terms);
	?>

		<div class="row">
			<div class="col-lg-12 gen-video-first-category">
				<h2><?php echo $firstTerm->name; ?></h2>
			</div>
		</div>

	<?php
	}
	?>

	<div class="row">
		<div class="col-lg-12">
			<div class="gen-video-holder">
				<?php masvideos_the_video(); ?>
			</div>

		</div>
		<div class="col-lg-12">
			<div class="gen-single-video-info">
				<h2 class="gen-title"><?php the_title(); ?></h2>
				<div class="gen-single-meta-holder">
					<?php Options::streamlab_video_meta_holder(); ?>
				</div>
				<div class="gen-excerpt">
					<?php Options::get_post_excerpt_or_content($current_post); ?>
				</div>
				<?php Options::get_sinle_post_share(get_the_permalink()); ?>
			</div>

		</div>

	</div>
</article>