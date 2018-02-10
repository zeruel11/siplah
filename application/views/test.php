<?php var_dump($test) ?>
<?php $this->output->enable_profiler(TRUE); ?>
<?= CI_VERSION ?><br>
<?= time() ?><br>
<?= date('d-m-Y') ?>
<!-- <input class="btn btn-info btn-lg" name="notif" type="button" value="Shoow notif" onclick="notify"/> -->

<!-- <script>
	$.notify("I'm over here !");
</script> -->
<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('beranda/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>
