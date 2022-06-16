<div class="nav-reserved-space"></div>
<div id="backgroundOverlay"></div>
<div id="snackbar">
    <div class="snackbar-message"></div>
</div>
<?php $version = wp_get_theme()->get('Version'); ?>

<script src="<?php echo get_template_directory_uri(); ?>/scripts/main.js?v=<?php echo $version; ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/scripts/menu-handler.js?v=<?php echo $version; ?>"></script>
</body>

</html>