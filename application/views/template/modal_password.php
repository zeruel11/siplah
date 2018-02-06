<div class="modal animated bounceIn fade" id="modalReminder" tabindex="-1" role="dialog" aria-labelledby="modalImportant" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalImportant">Perhatian!</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Password Anda baru saja direset, harap segera melakukan <strong>penggantian password</strong>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" id="cancelModal" data-dismiss="modal">Cancel</button>
				<button type="button" id="passwordPopup" class="btn btn-primary">Ganti Sekarang</button>
			</div>
		</div>
	</div>
</div>

<form name="modalPassword" id="modalPassword" method="post" class="modal animated fade" tabindex="-1" role="dialog" aria-labelledby="modalImportant" action="<?= base_url('index.php/Ver_login/changepwd/').$userLogin['uid'] ?>">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalImportant">Ganti password</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Masukkan password lama anda: <input type="password" id="sandiLewat" name="sandiLewat" placeholder="******" required oninvalid="this.setCustomValidity('Masukkan password lama')" oninput="setCustomValidity('')"></input>
			</div>
			<div class="modal-body">
				Masukkan password baru anda: <input type="password" id="sandiLewatBaru" name="sandiLewatBaru" placeholder="******" required oninvalid="this.setCustomValidity('Masukkan password baru')" oninput="setCustomValidity('')"></input>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">OK</button>
			</div>
		</div>
	</div>
</form>

<?php if (isset($pwd)): ?>
	<script type="text/javascript">
	$(window).on('load', function(){
	$('#modalReminder').modal({
		show: true,
		focus: true,
		keyboard: false
	})
});
	</script>
<?php endif; ?>

<script type="text/javascript">
	$('#modalReminder').on('hide.bs.modal', function () {
		// $('.modal .modal-dialog').attr('class', 'modal-dialog zoomOut animated');
		$('#modalReminder').removeClass("bounceIn");
		$('#modalReminder').addClass("zoomOut");
	});

	function whichTransitionEvent() {
		var t,
			el = document.createElement("fakeelement");

		var transitions = {
			"transition": "transitionend",
			"OTransition": "oTransitionEnd",
			"MozTransition": "transitionend",
			"WebkitTransition": "webkitTransitionEnd"
		}

		for (t in transitions) {
			if (el.style[t] !== undefined) {
				return transitions[t];
			}
		}
	}

	var transitionEvent = whichTransitionEvent();

	$("#passwordPopup").click(function() {
		$('#modalReminder').modal('hide');
		$(this).one(transitionEvent,
			function(event) {
				$('#modalPassword').modal({
					show: true,
					focus: true,
					keyboard: false
				});
		});
	});

	$('#modalPassword').on('show.bs.modal', function() {
		$('#modalPassword').removeClass("zoomOut");
		$('#modalPassword').addClass("zoomIn");
	});
	$('#modalPassword').on('shown.bs.modal', function() {
		$('#sandiLewat').focus();
	});
	$('#modalPassword').on('hide.bs.modal', function() {
		$('#modalPassword').removeClass("zoomIn");
		$('#modalPassword').addClass("zoomOut");
	});
</script>

<script>
$(window).on('load', function(event) {
	setTimeout(function () {
		$(".alert").alert('close')
	}, 3500);
})

$(function () {
		$('body').on('close.bs.alert', function(e){
				e.preventDefault();
				e.stopPropagation();
				$(e.target).slideUp();
		});
});
</script>
