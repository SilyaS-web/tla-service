<script>
export default {
    name: "BloggerCardLoading"
}
</script>

<template>
    <div class="loading-blogger">
        <div class="loading-blogger__header _loading-row">
        </div>
        <div class="loading-blogger__body">
            <div class="loading-blogger__loading-stats _loading-row"></div>
            <div class="loading-blogger__loading-row">
                <div class="loading-blogger__loading-col loading-blogger__loading-col--two-third  _loading-row"></div>
                <div class="loading-blogger__loading-col loading-blogger__loading-col--one-third _loading-row"></div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.loading-blogger{
    display: flex;
    gap: 12px;
    flex-direction: column;
    height: 100%;
    width: calc(100% / 3 - 10px);
    max-width: 510px;
    padding: 20px;
    background-color: #fff;
    min-width: 337px;
    border: 1px solid #F5F5F5;
}
.loading-blogger__header{
    height: 175px;
    width: 100%;
    border-radius: 10px;
    overflow: hidden;
}
.loading-blogger__body{
    margin-top: 21px;
    display: flex;
    flex-direction: column;
    gap: 30px;
    width: 100%;
}
.loading-blogger__loading-stats{
    width: 100%;
    height: 125px;
    border-radius: 10px;
    overflow: hidden;
}
.loading-blogger__loading-row{
    width: 100%;
    display: flex;
    gap: 8px;
}
.loading-blogger__loading-col{
    height: 46px;
    border-radius: 10px;
    overflow: hidden;
}
.loading-blogger__loading-col--one-third{
    width:calc(33.33% - 4px);
}
.loading-blogger__loading-col--two-third{
    width:calc(67.77% - 4px);
}
@media (max-width: 675px) {
    .loading-blogger {
        width: 100%;
        min-width: unset;
    }
}
</style>
