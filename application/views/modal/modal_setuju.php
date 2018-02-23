<!-- Modal Setuju -->

<form lang="en" name="input" id="modalSetuju<?= $idModal ?>" class="modal animated fade" tabindex="-1" role="dialog" aria-labelledby="modalSetuju" method="post" action="<?= base_url('renovasi/setuju/').$idModal ?>" novalidate>
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalSetuju">Lakukan persetujuan renovasi?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<label for="danaForm" class="form-control-label">Masukkan alokasi dana:</label>
				<div class="input-group">
					Rp. <input type="number" class="form-control ml-2" id="danaForm" name="danaForm" placeholder="1000000" />
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" id="next" class="btn btn-success">Setuju</button>
				<button type="button" class="btn btn-secondary" id="cancelModal" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
// $("#next").click(function(){
// 		var form = $("#modalSetuju<?= $idModal ?>");
// 		form.validate({
// 			rules: {
// 				danaForm: {
// 					required: true,
// 					number: true
// 				}
// 			},
// 			messages: {
// 				danaForm: {
// 					required: '<div class="invalid-feedback">Anda perlu memasukkan alokasi dana renovasi</div>',
// 					number: "Harap masukkan angka"
// 				}
// 			}
// 		});
// 	});

$( document ).ready( function () {
			$( "#modalSetuju<?= $idModal ?>" ).validate( {
				rules: {
					danaForm: {
						required: true,
						number: true
					}
				},
				messages: {
					danaForm: {
						required: 'Anda perlu memasukkan alokasi dana renovasi',
						number: "Harap masukkan angka"
					}
				},
				errorElement: "div",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "invalid-feedback" );
					error.insertAfter( element.parent( "div" ) );
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
				}
			} );
		});

		// 		errorPlacement: function ( error, element ) {
		// 			// Add the `help-block` class to the error element
		// 			error.addClass( "help-block" );

		// 			// Add `has-feedback` class to the parent div.form-group
		// 			// in order to add icons to inputs
		// 			element.parents( ".modal-body" ).addClass( "has-feedback" );

		// 			if ( element.prop( "type" ) === "checkbox" ) {
		// 				error.insertAfter( element.parent( "label" ) );
		// 			} else {
		// 				error.insertAfter( element );
		// 			}

		// 			// Add the span element, if doesn't exists, and apply the icon classes to it.
		// 			// if ( !element.next( "span" )[ 0 ] ) {
		// 			// 	$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
		// 			// }
		// 		},
		// 		success: function ( label, element ) {
		// 			// Add the span element, if doesn't exists, and apply the icon classes to it.
		// 			if ( !$( element ).next( "span" )[ 0 ] ) {
		// 				$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
		// 			}
		// 		},
		// 		highlight: function ( element, errorClass, validClass ) {
		// 			$( element ).parents( ".modal-body" ).addClass( "has-error" ).removeClass( "has-success" );
					// $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
		// 		},
		// 		unhighlight: function ( element, errorClass, validClass ) {
		// 			$( element ).parents( ".modal-body" ).addClass( "has-success" ).removeClass( "has-error" );
					// $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
		// 		}
		// 	} );
		// } );
</script>
