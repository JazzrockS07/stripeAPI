<?php



// Exit if accessed directly.

if ( ! defined( 'ABSPATH' ) ) {

	return;

}



class customFooter extends App {



	private static function copyright() {

		?>

		<div class="copyright"><?= sprintf(__('&copy; %s  Yellow Bus', TEXT_DOMAIN), date('Y')) ?></div><!-- End: copyright -->

		<?php

	}



	private static function footerLogo() {

		?>

		<!--== Start: Footer Widget ==-->

		<div class="footer-widget text-center text-md-start">

			<a class="footer-widget-logo me-auto me-md-0 ms-auto ms-md-0"

			   href="#">

				<img src="<?php echo do_shortcode('[theme_url]')?>/assets/images/logo-light.png" alt="Logo" />

			</a>

		</div>

		<!--== Start: Footer Widget ==-->

		<?php

	}



	private static function footerMenu($title = 'Resources', $slug = 'footer-main' ) {

		?>



		<h4 class="footer-widget-title"><?php _e($title,'yellow'); ?></h4>

		<h4

				class="collapsed-title collapsed"

				data-bs-toggle="collapse"

				data-bs-target="#divider-<?php echo $slug ?>"

				aria-expanded="false"

		>

			<?php _e($title,'yellow'); ?>

		</h4>



		<div id="divider-<?php echo $slug ?>" class="widget-collapse-body collapse">

			<?php wp_nav_menu(array(

				'theme_location'  => $slug,

				'container'       => false,

				'fallback_cb'    => '__return_false',

				'container_class' => false,

				'container_id'    => false,

				'menu_class'      => 'footer-widget-nav',

				'depth'           => 10,

				'walker'          => new Clean_Walker_Nav(),

			)); ?>

		</div>



		<?php

	}



	private static function footerDetails($title = 'Contact Us') {

		?>



		<h4 class="footer-widget-title"><?php _e($title,'yellow'); ?></h4>

		<h4

				class="collapsed-title collapsed"

				data-bs-toggle="collapse"

				data-bs-target="#divider-details"

				aria-expanded="false"

		>

			<?php echo $title ?>

		</h4>



		<div id="divider-details" class="widget-collapse-body collapse">

			<ul class="footer-widget-info">

				<li>

					<i class="icofont-ui-call"></i>

					<a href="tel://5123602763">+40 741 010 358</a>

				</li>

				<li>

					<i class="icofont-envelope-open"></i>

					<a href="mailto://ro@yellowbus.info">ro@yellowbus.info</a>

				</li>

				<li>

					<i class="icofont-location-pin"></i>

					<p><?php _e('We act at the border','yellow'); ?></p>

				</li>



				<li>

					<i class="icofont-telegram"></i>

					<a href="https://t.me/yellowbusinfo" class="text">yellowbusinfo</a>

				</li>



			</ul>

		</div>

		<?php

	}



	public static function render() {

		?>

		<div class="topfooter section-padding bg-primary">

			<div class="container mb-n3">

				<h3><?php _e('Project funded by Care','yellow'); ?></h3>

				<p><?php _e('global confederation that has been fighting poverty and social injustice for over 75 years and is coordinated and implemented at national level by the SERA Romania Foundation (non-governmental, non-profit, private organization, which has been active for 26 years in the field of child protection and rights children in Romania) with the support of Care France and FONPC (Federation of Non-Governmental Organizations for Children)','yellow'); ?></p>

			</div>

		</div>

		<footer class="footer-section section">

			<!--== Start: Footer Main ==-->

			<div class="footer-main section-padding bg-img bg-secondary">



				<div class="container mb-n3">

					<div class="row align-items-top">

						<div class="col-md-4 col-lg-3 mb-8 mb-md-0">



							<div class="footer-widget">

								<?php self::footerLogo(); ?>

							</div>



						</div>

						<div class="col-md-8 col-lg-6">



							<div class="footer-widget">

								<div class="row">

									<div class="col-md-6 footer-widget-nav1">

										<?php self::footerMenu(); ?>

									</div>

									<div class="col-md-6 footer-widget-nav2">

										<?php self::footerMenu('Legal', 'footer-secondary'); ?>

									</div>

								</div>

							</div>



						</div>

						<div class="col-lg-3 ps-3 ps-xl-10 mt-8 mt-lg-0">



							<div class="footer-widget">

								<?php self::footerDetails(); ?>

							</div>



						</div>

					</div>

				</div>

			</div>

			<!--== End: Footer Main ==-->

		</footer>

		<?php

	}
	
}

$customFooter = new customFooter();


