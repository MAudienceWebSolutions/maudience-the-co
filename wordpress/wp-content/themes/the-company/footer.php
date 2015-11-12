		<section class="section-contacts">
			<div class="shell">
				<ul class="widgets">
					<?php
					get_template_part( 'fragments/contact-info' );
					get_template_part( 'fragments/contact-hours' );
					get_template_part( 'fragments/social-icons' );
					?>
				</ul><!-- /.widgets -->
			</div><!-- /.shell -->
		</section><!-- /.section-contacts -->

		<footer class="footer">
			<div class="shell clearfix">
				<?php
				$copyright_text = carbon_get_theme_option( 'crb_copyright_text' );
				if ( $copyright_text ): ?>
					<div class="copyright">
						<?php echo wpautop( do_shortcode( $copyright_text ) ); ?>
					</div><!-- /.copyright -->
				<?php endif; ?>

				<?php
				wp_nav_menu(array(
					'theme_location'  => 'footer-menu',
					'container'       => 'nav',
					'container_class' => 'footer-nav',
					'fallback_cb'     => false,
					'depth'           => 1,
				));
				?>
			</div><!-- /.shell -->
		</footer><!-- /.footer -->
	</div><!-- /.wrapper -->
<?php wp_footer(); ?>
</body>
</html>