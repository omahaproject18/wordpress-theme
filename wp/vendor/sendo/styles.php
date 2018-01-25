<?php global $sendo; ?>

<?php foreach ($sendo->css as $val): ?>
	<?php if ($val != false): ?>
		<?php $sendo->capture_javascript_start(); ?>
			<script type="text/javascript">
				$(document).ready(function() {
					if (!document.querySelectorAll("link[href='<?php echo $val; ?>']").length) {
						file = "<?php echo $val ?>";

						link = document.createElement( "link" );
						link.href = file;
						link.type = "text/css";
						link.rel = "stylesheet";
						link.media = "screen,print";

						document.getElementsByTagName( "head" )[0].appendChild( link );
					}
				});
			</script>

			<noscript>
				<style type="text/css">
					@import url('<?php echo $val; ?>');
				</style>
			</noscript>
		<?php $sendo->capture_javascript_end(); ?>
	<?php endif; ?>
<?php endforeach; ?>
