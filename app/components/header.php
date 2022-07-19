<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	return;
}


class customHeader extends App {

	private static function social() {
		?>
		<ul class="social">
		<li><a href="#"><i class="fab fa-youtube"></i></a></li>
			<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
			
		</ul><!-- End: social -->
		<?php
	}

	private static function infolist() {
		?>
		<ul class="header-top-info-list">
		<li>
			<a href="tel://5123602763" class="text"><i class="icofont-ui-call"></i>
				+40 741 010 358
				</a
			>
		</li>
		<li>
			<i class="icofont-envelope-open"></i>
			<a href="mailto://ro@yellowbus.info" class="text"
				>ro@yellowbus.info</a
			>
		</li>
		<li>
			<i class="icofont-telegram"></i>
			<a href="https://t.me/yellowbusinfo" class="text"
				>yellowbusinfo</a
			>
		</li>
		
	</ul>
		<?php
	}

	private static function languageswitch() {
		?>
			<!---
		<ul class="header-top-info-list header-top-lang">
			<li class="active">EN</li>
			<li>UA</li>
			<li>RO</li>

		</ul>
		-->

		<ul class="header-top-info-list header-top-lang"><?php pll_the_languages();?></ul>
		<?php
	}
	private static function donate() {
		?>
		<a class="btn btn-primary header-donate-btn" href="https://yellowbus.info/ro/doneaza"><?php _e('Donate','yellow') ?></a>
		<?php
	}

	private static function logo() {
		$logo = get_template_directory_uri() . '/assets/images/logo.png';
		?>
		<div class="header-logo py-lg-5">
			<a href="<?= home_url('/') ?>">
				<img
					class="logo-main"
					src="<?= $logo ?>"
					alt="Yellow Bus"
				/>
			</a>
		</div>

		<?php
	}

	private static function primary_menu($menu = 'primary-menu') {
		?>
	
			<?php wp_nav_menu(array(
				'theme_location'  => 'primary-menu',
				'container'       => false,
				'container_class' => false,
				'container_id'    => false,
				'menu_class'      => 'main-nav justify-content-center',
				'depth'           => 10,
				'walker'          => new bootstrap_5_wp_nav_menu_walker(),
			)); ?>
		
		<?php
	}

	private static function headerTop() {
		?>
	
		<!--== Start: Header Top ==-->
		<div class="header-top d-none d-lg-block">
			<div class="container-fluid header-container-fluid">
				<div class="row justify-content-between">
					<div class="col-auto">
						<?php self::infolist(); ?>
					</div>
					<div class="col-auto">
						<?php self::languageswitch(); ?>
					</div>
				</div>
			</div>
		</div>
		<!--== End: Header Top ==-->
			
		<?php
	}
	private static function headerBottom() {
		?>
			<!--== Start: Header Bottom ==-->
		<div class="header-bottom sticky-header">
			<div class="container-fluid header-container-fluid">
				<div class="row justify-content-between align-items-center">
					<div class="col-auto">
					<?php self::logo(); ?>
					</div>
					<div class="col-auto d-none d-lg-block">
						<div class="header-navigation">
						<?php self::primary_menu(); ?>
						</div>
					</div>
					<div class="col-auto d-flex align-items-center gap-6 gap-lg-0">
						<?php self::donate(); ?>
						<button
							class="btn-menu d-flex d-lg-none"
							type="button"
							data-bs-toggle="offcanvas"
							data-bs-target="#AsideOffcanvasMenu"
							aria-controls="AsideOffcanvasMenu"
						>
							<span></span>
							<span></span>
							<span></span>
						</button>
					</div>
				</div>
			</div>
		</div>
		<!--== End: Header Bottom ==-->
		<?php
	}

	private static function headerAside() {
		?>
		<!--== Start: Header Aside ==-->
		<aside
			class="off-canvas-wrapper offcanvas offcanvas-start"
			tabindex="5"
			id="AsideOffcanvasMenu"
			aria-labelledby="offcanvasExampleLabel"
		>
			<div class="offcanvas-header">
				<h6 class="d-none" id="offcanvasExampleLabel"><?php _e('Aside Menu','yellow') ?></h6>
				<button
					class="btn-menu-close"
					data-bs-dismiss="offcanvas"
					aria-label="Close">
					<?php _e('menu','yellow') ?><i class="icofont-rounded-left"></i>
				</button>
			</div>
			<div class="offcanvas-body">
				<div class="mobile-menu-action">
					<!-- Mobile Menu Start -->
					<div class="mobile-menu-items">
						<?php self::primary_menu(); ?>
					</div>
					<!-- Mobile Menu End -->
					<ul class="mobile-menu-info-list">
						
					</ul>
				</div>
				<?php self::donate(); ?>
			</div>
		</aside>
		<!--== End: Header Aside ==-->
		<?php
	}

	public static function render() {
		?>
		<header class="header-wrapper">
			<?php self::headerTop(); ?>
			<?php self::headerBottom(); ?>
		</header><!-- End: custom-header -->
		<?php self::headerAside(); ?>
		<?php
	}
	
}
