import {ref} from "vue";

export default {
    name: "LoadingListItems",
    data(){
        return {
            loadingItemsCount: ref(0), //calculate var for loading items render

            _list: ref('_list'), //list class name for calculation
            _listItem: ref('_listItem'), //list item class name for calculation

            listName: '', //variable with items name
        }
    },
    updated(){
        if(this[this.listName] && this[this.listName].length > 0) this.calculateLoadingItemsCount()
    },
    watch:{
    },
    methods:{
        calculateLoadingItemsCount(){
            const listWidth = $(this.$el).find(`.${this._list}`).width();
            const listItemWidth = $(this.$el).find(`.${this._listItem}`).width();
            const rowFitsCount = Math.floor(listWidth / listItemWidth)

            if(!listItemWidth) return 0;

            let rowRestCount = 0

            const listItemsLength = this[this.listName] && this[this.listName].length

            if(listItemsLength && listItemsLength > 0) {
                const totalFitsCount = Math.floor(listItemsLength / rowFitsCount);
                rowRestCount = listItemsLength - (totalFitsCount * rowFitsCount)
            }

            this.loadingItemsCount = (rowFitsCount - rowRestCount) + rowFitsCount
        },

    }
}
