<script>
export default {
    name: "ProjectCardLoading"
}
</script>

<template>
    <div class="loading-project">
        <div class="loading-project__image _loading-row">
        </div>
        <div class="loading-project__content">
            <div class="loading-project__loading-row _loading-row"></div>
            <div class="loading-project__loading-row _loading-row"></div>
            <div class="loading-project__loading-row _loading-row"></div>
        </div>
    </div>
</template>

<style scoped>
.loading-project{
    width: calc(100% / 4 - 10px);
    background-color: #fff;
    border-radius: 10px;
    padding: 15px;
    min-width: 250px;
    display: flex;
    flex-direction: column;
    max-width: 320px;
    transition: box-shadow .2s linear;
    cursor: pointer;
    gap: 6px;
}
.loading-project__image{
    position: relative;
    margin-bottom: 10px;
    width: 100%;
    background-repeat: no-repeat;
    background-size: cover;
    padding-top: 270px;
    border-radius: 10px;
}
.loading-project__content{
    display: flex;
    flex-direction: column;
    flex: 1 1 auto;
    margin-top: 15px;
    gap: 8px;
}
.loading-project__content > *{
    width: 100%;
    height: 24px;
}
@media (max-width: 1045px) {
    .loading-project {
        width: calc(100% / 2 - 10px);
    }
}
@media (max-width: 745px) {
    .loading-project {
        min-width: 225px;
    }
}
@media (max-width: 675px) {
    .loading-project {
        padding: 0;
    }
}
@media (max-width: 545px) {
    .loading-project {
        min-width: unset;
        width: calc(100% / 2 - 3px);
    }
}
</style>
