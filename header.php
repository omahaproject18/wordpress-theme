<techomaha-header>
	<a href="/">
		<smart-image>
			<source />
			<source />
			<source />
			<source />
		</smart-image>
	</a>
	<nav slot="links">
		<?php
			wp_nav_menu(
				array(
					'menu'    => 'Navigation',
					'walker'  => new SPLITINFINITIES_Walker_Nav_Menu(),
					'items_wrap' => '%3$s',
					'container' => false
				)
			);
		?>
	</nav>
	<nav slot="social">
		<a href="#"><techomaha-svg name="md-heart" /></a>
		<a href="#"><techomaha-svg name="md-heart" /></a>
		<a href="#"><techomaha-svg name="md-heart" /></a>
	</nav>
</techomaha-header>
