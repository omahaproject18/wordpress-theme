<techomaha-footer>
	<section class="bg-gray5">
		<copy-wrap align="center">
			<h1>Keep updated by joining Slack, Mailchimp, or&nbsp;Tinyletter.</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
			<techomaha-form>
				<form>
					<techomaha-input label="Your email address" />
					<techomaha-grid>
						<techomaha-input label="Your first name" />
						<techomaha-input label="Your last name" />
					</techomaha-grid>
					<techomaha-toggle-group>
						<techomaha-toggle value="slack" label="Join Slack" />
						<techomaha-toggle value="mailchimp" label="Join Mailchimp" />
						<techomaha-toggle value="tinyletter" label="Join Tinyletter" />
					</techomaha-toggle-group>
					<techomaha-button type="submit">Invite me!</techomaha-button>
				</form>
			</techomaha-form>
		</copy-wrap>
	</section>
	<section>
		<nav>
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
	</section>
	<section class="bt b--gray15">
		<p>Hosting provided by <techomaha-svg name="flywheel" />. Meet ups provided by <techomaha-svg name="agape-red" />. This work is licensed MIT and available on our <a href="#" target="_blank">Github organization</a>.</p>
	</section>
</techomaha-footer>
