const _paginationTickEvent = '_paginationLoadItems';

const _pageSize = 10;
const _observerOptions = {
    threshold: 0.75
};

let _count = 10;

import {ref} from "vue";

const Pagination = {
    data(){
        return {
            paginationObserver: null,
            paginationEntryElement: ref(null),
        }
    },
    watch: {
        paginationEntryElement(){
            this.paginationObserver = new IntersectionObserver(this.paginationCallback, _observerOptions)
            this.paginationObserver.observe(document.querySelector(this.paginationEntryElement))
        }
    },
    mounted(){ },
    unmounted(){  if(this.paginationObserver) this.paginationObserver.disconnect() },
    methods:{
        paginationCallback(entries, observer){
            entries.forEach((entry) => {
                console.log(entry)
                if(!entry.isIntersecting){
                    return;
                }

                _count += _pageSize

                window.dispatchEvent(new CustomEvent(this.getPaginationEventTick(), {
                    detail: {
                        itemsCount: _count
                    }
                }));
            })
        },
        getPaginationEventTick(){ return _paginationTickEvent }
    }
}

export default Pagination
