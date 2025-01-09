<script>
    const Meter = {
        init: (percents = 0) => {
            if(!percents || percents == 0){
               return
            }

            const mediaQueryBig = window.matchMedia('(max-width: 1380px)')
            const mediaQueryAv = window.matchMedia('(max-width: 1300px)')
            const mediaQuerySmall = window.matchMedia('(max-width: 612px)')
            const mediaQuerySmaller = window.matchMedia('(max-width: 450px)')
            var r = 190;

            if (mediaQuerySmaller.matches) {
                r = 100
            }
            else if (mediaQuerySmall.matches) {
                r = 120
            }
            else if (mediaQueryAv.matches) {
                r = 170
            }
            else if(mediaQueryBig.matches){
                r = 190
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
            var semi_cf_1by3 = semi_cf / 3;

            document.querySelector('#outline_curves')
                .setAttribute('stroke-dasharray', semi_cf_1by3 + ',' + cf);

            document.querySelector('#low')
                .setAttribute('stroke-dasharray', semi_cf + ',' + cf);
            document.querySelector('#avg')
                .setAttribute('stroke-dasharray', semi_cf / 2 + ',' + cf);
            document.querySelector('#high')
                .setAttribute('stroke-dasharray', cf / 10  + ',' + cf);

            document.querySelector('#outline_ends')
                .setAttribute('stroke-dasharray', 2 + ',' + (semi_cf - 2));

            /*bind range slider event*/
            var meter_needle =  document.querySelector('#meter_needle');

            function range_change_event() {
                meter_needle.style.transform = 'rotate(' + (270 + ((percents * 180) / 100)) + 'deg)';
            }

            range_change_event();
        }
    }

    export default Meter
</script>
