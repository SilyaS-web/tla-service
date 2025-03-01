function calculateLoadingItemsCount(listItemSelector, listItemsLength, defaultItemsCount){
    const listWidth = $(this.$el).width();
    const listItemWidth = $(this.$el).find(listItemSelector).width();

    if(!listItemWidth) return defaultItemsCount

    const rowFitsCount = Math.round(listWidth / listItemWidth)

    let rowRestCount = 0

    if(listItemsLength) {
        const totalFitsCount = Math.round(listItemsLength / rowFitsCount);
        rowRestCount = listItemsLength - (totalFitsCount * rowFitsCount)
    }

    return (rowFitsCount - rowRestCount) + rowFitsCount
}

export {calculateLoadingItemsCount}
