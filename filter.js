 $(document).ready(function () {
	$('.archive-filter-category').SumoSelect({
	captionFormatAllSelected: 'Выбраны: Все!',
	placeholder: 'Жанры',   
	});
	
	$('.archive-filter-category').on('change', function (e) {
		$( "#afa" ).prop( "disabled", false );
	});
	
	$('#archive-filter-date').datepicker({
		multipleDatesSeparator: ';',
		dateFormat: "yyyy.mm.dd",
		onSelect: function(fd, d, picker) {
			$( "#afa" ).prop( "disabled", false );
			$( "#afd" ).prop( "disabled", false );
			$( "#afd" ).val(fd);
        }
	});
	if(window.location.search) $( "#afr" ).prop( "hidden", false );
	$(".js-range-slider").ionRangeSlider({
	type: "double",
	skin: "round",
	step: 100,
	grid: true,
	onChange:function(data) {
		$( "#afa" ).prop( "disabled", false );
	}
	
});
});
