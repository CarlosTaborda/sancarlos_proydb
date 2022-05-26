</div>
<script src="<?= base_url("assets/plugins/vue.js"); ?>" ></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
<?php if( !empty($load_files) ): ?>
<?php foreach($load_files as $f): ?>
<?= $f."\n" ?>
<?php endforeach; ?>
<?php endif; ?>
</body>
</html>
