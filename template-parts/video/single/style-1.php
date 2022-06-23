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
		<div class="col-lg-12">
			<div class="pm-inner">
				<div class="gen-more-like">
					<h5 class="gen-more-title"><?php Options::get_single_load_title('single_video'); ?></h5>
					<div class="<?php echo esc_attr(Options::get_inner_row_class('single_video')); ?>">
						<?php

						$box_style = Options::get_box_style('movie');

						if (!empty($args)) {
							$box_style = $args['box_style'];
						}

						$args = array(
							'post_type'         => 'video',
							'post_status'       => 'publish',

						);

						$args = Options::get_single_load_filter('video', $args);
						$wp_query = new \WP_Query($args);
						$nonce =  wp_create_nonce('loadmore_nonce');
						echo '<div class="post-loadmore-data" data-box_style="' . esc_attr($box_style) . '" data-query="' . esc_attr(json_encode($wp_query->query_vars)) . '" data-paged="' . esc_attr($paged) . '" data-max="' . esc_attr($wp_query->max_num_pages) . '" data-nonce="' . esc_attr($nonce) . '" data-post_type="video"></div>';
						if ($wp_query->have_posts()) {
							while ($wp_query->have_posts()) {
								$wp_query->the_post();
						?>
								<div class="<?php echo esc_attr(Options::get_main_column_number_class('video')) ?>">
									<?php
									get_template_part("template-parts/video/content", "style-{$box_style}");
									?>
								</div>
						<?php
							}
							wp_reset_query();
						}
						?>

					</div>

					<div class="row">
						<?php
						Gentech_Load_More::instance()->init(Options::get_load_type('single_video'));
						?>

					</div>
				</div>

			</div>


		</div>
	</div>
</article>