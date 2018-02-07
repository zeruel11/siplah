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
				Password Anda baru saja direset, harap segera melakukan <a id="close" target="_blank" href="<?= base_url('gantipassword').$userLogin['uid'] ?>">penggantian password</a>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" id="cancelModal" data-dismiss="modal">OK</button>
				<!-- <button type="button" id="passwordPopup" class="btn btn-primary">Ganti Sekarang</button> -->
			</div>
		</div>
	</div>
</div>

<!-- <form name="modalPassword" id="modalPassword" method="post" class="modal animated fade" tabindex="-1" role="dialog" aria-labelledby="modalImportant" action="<?= base_url('index.php/Ver_login/changepwd/').$userLogin['uid'] ?>">
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
</form> -->

<script type="text/javascript">
	<?php if (isset($pwd)): ?>
	$(window).on('load', function(){
	$('#modalReminder').modal({
		show: true,
		focus: true,
		keyboard: false
		})
	});
	<?php endif; ?>

$('#close').on('click', function() {
	$('#modalReminder').modal('hide');
})
	$('#modalReminder').on('hide.bs.modal', function () {
		// $('.modal .modal-dialog').attr('class', 'modal-dialog zoomOut animated');
		$('#modalReminder').removeClass("bounceIn");
		$('#modalReminder').addClass("zoomOut");
	});
</script>
	<!-- function whichTransitionEvent() {
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

	$("#passwordPopup").on('click', function() {
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
	}); -->


<!-- <script type="text/javascript">
	$(#test).click(function () {
		$.ajax({
    url: base_url+"index.php/Ver_login/changepwd/"+userLogin['uid'],
    type: "POST",
    data: {
    	username: userLogin['username'],
    	password: $("#sandiLewat").val()
    },
    sucesss: function(data) {
    	alert(data);
        // if (data == false) {
        // 	$("#ajax_div").html("Username is taken, choose another!");
        // }
        // else {
        // 	$("#ajax_div").html("Username is free");
        // }
    }
});
	})
</script> -->
<!-- <script type="text/javascript">
	$("#modalPassword").validate({
        rules: {
            sandiLewat: {
                required: true,
                remote: {
                    url: base_url+"Ver_login"+$userLogin['uid'],
                    type: "post"
                 }
            }
        },
        messages: {
            sandiLewat: {
                required: "Please Enter Email!",
                remote: "Email already in use!"
            }
        }
    });
</script> -->
<!-- <script type="text/javascript">
	// var base_url = <?= base_url() ?>;
	$().ready(function() {

    $.validator.addMethod("checkPass",
        function(value, element) {
            var result = false;
            $.ajax({
                type:"POST",
                async: false,
                url: "Ver_login", // script to validate in server side
                data: {sandiLewat: value},
                success: function(data) {
                    result = (data == true) ? true : false;
                }
            });
            // return true if username is exist in database
            return result;
        },
        "This username is already taken! Try another."
    );

    // validate signup form on keyup and submit
    $("#modalPassword").validate({
        rules: {
            "sandiLewat": {
                required: true,
                checkPass: true
            }
        }
    });
});
</script> -->
<!-- <script type="text/javascript">
	$.validator.addMethod("checkExists", function(value, element)
{
    var inputElem = $('#modalPassword :input[name="sandiLewat"]'),
        data = { "password" : inputElem.val() },
        eReport = ''; //error report

    $.ajax(
    {
        type: "POST",
        url: base_url+"Ver_login",
        dataType: "json",
        data: data,
        success: function(returnData)
        {
            if (returnData!== 'true')
            {
              return '<p>This email address is already registered.</p>';
            }
            else
            {
               return true;
            }
        },
        error: function(xhr, textStatus, errorThrown)
        {
            alert('ajax loading error... ... '+url + query);
            return false;
        }
    });

}, '');
</script> -->
