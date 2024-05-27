$(window).on('load', function(){
	const mediaQueryBig = window.matchMedia('(max-width: 1380px)')
	const mediaQueryAv = window.matchMedia('(max-width: 1100px)')
	const mediaQuerySmall = window.matchMedia('(max-width: 612px)')
	const mediaQuerySmaller = window.matchMedia('(max-width: 450px)')
	var r = 190;
	
	if (mediaQuerySmaller) {
		r = 100
	}
	else if (mediaQuerySmall) {
		r = 120
	}
	else if (mediaQueryAv.matches) {
		r = 190
	}
	else if(mediaQueryBig.matches){
		r = 160
	}

	var circles = document.querySelectorAll('.circle');
	var total_circles = circles.length;
	for (var i = 0; i < total_circles; i++) {
		circles[i].setAttribute('r', r);
	}
	/* set meter's wrapper dimension */
	var meter_dimension = (r * 2) + 100;
	var wrapper = document.querySelector('#wrapper');
	wrapper.style.width = meter_dimension + 'px';
	wrapper.style.height = meter_dimension + 'px';
	/* add strokes to circles  */
	var cf = 2 * Math.PI * r;
	var semi_cf = cf / 2;
	var semi_cf_half = cf / 2;
	var semi_cf_1by3 = semi_cf / 3;
	var semi_cf_2by3 = semi_cf_1by3 * 2;
	var semi_cf_1by4 = semi_cf / 4;
	document.querySelector('#outline_curves')
		.setAttribute('stroke-dasharray', semi_cf_1by3 + ',' + cf);
	
	document.querySelector('#low')
		.setAttribute('stroke-dasharray', semi_cf + ',' + cf);
	document.querySelector('#avg')
		.setAttribute('stroke-dasharray', semi_cf / 2 + ',' + cf);
	document.querySelector('#high')
		.setAttribute('stroke-dasharray', cf / 16  + ',' + cf);
		
	document.querySelector('#outline_ends')
		.setAttribute('stroke-dasharray', 2 + ',' + (semi_cf - 2));
	/*bind range slider event*/
	var lbl = document.querySelector("#lbl");
	var mask = document.querySelector('#mask');
	var meter_needle =  document.querySelector('#meter_needle');
	function range_change_event() {
		var percent = $(meter_needle).data('percents');
	
		meter_needle.style.transform = 'rotate(' + (270 + ((percent * 180) / 100)) + 'deg)';
	}
	range_change_event();
})


		
        