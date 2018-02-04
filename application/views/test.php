<?php var_dump($test) ?>
<?php $this->output->enable_profiler(TRUE); ?>
<input class="btn btn-info btn-lg" name="notif" type="button" value="Shoow notif" onclick="notify"/>

<script>
	$.notify("I'm over here !");
</script>
