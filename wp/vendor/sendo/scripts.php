<?php global $sendo; ?>

<?php foreach ($sendo->js as $val): ?>
	<?php if ($val != false): ?>
		<?php if ((substr( $val, 0, 7 ) === "http://") || (substr( $val, 0, 8 ) === "https://") || (substr( $val, 0, 2 ) === "//")): ?>
			<script type="text/javascript" src="<?php echo $val; ?>"></script>
		<?php else: ?>
			<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/' . $val; ?>"></script>
		<?php endif; ?>
	<?php endif; ?>
<?php endforeach; ?>
