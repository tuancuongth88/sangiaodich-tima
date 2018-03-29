$(document).ready(function(){

	$(document).on('change', 'select#cbCity', function(){
		var city = $(this).val();
		$('select#cbDistrict').val('').change();
		$('select#cbDistrict').removeAttr('disabled');
		$('select#cbDistrict').empty();
		if( city != '' ){
			$option = '';
			$('select#cbDistrict-hidden>option[data-cityid="'+city+'"]').each(function(index, el) {
				$('select#cbDistrict').append($(el).clone());
			});
			// $('select#cbDistrict').find('>option[data-cityid="'+city+'"]');
		}
		$('select#cbDistrict').selectpicker('refresh', {
			liveSearch: true,
		});
	})

});