<template>
    <footer class="footer">
        <div class="footer__container _container">
            <div class="footer__body">
                <a href="https://adswap.ru/privacy" target="_blank" class="footer__policy">
                    Политика конфиденциальности
                </a>
                <a href="https://adswap.ru/agreement" target="_blank" class="footer__policy">
                    Пользовательское соглашение
                </a>
                <a href="mailto:adswap.ru@ya.ru" class="footer__policy">
                    adswap.ru@ya.ru
                </a>
            </div>
        </div>
    </footer>
</template>
<script>
    export default {}
</script>
<style scoped>
.footer {
    border-top: 1px solid rgba(0, 0, 0, .12);
    background-color: #fff;
    margin-top: auto;
    position: absolute;
    width: 100%;
    bottom: 0;
    font-size:14px;
}
.footer__container {
    margin: 0 auto;
    padding:15px
}
._container {
}
.footer__body {
    display: flex;
    justify-content: center;
    gap: 15%;
    flex-wrap: wrap;
}
.footer__top {
    display: flex;
    margin-bottom: 15px;
    justify-content: space-between;
}
.logo {
}
.footer__logo-w {
    margin-right: 15vw;
}
.logo__logo {
}
.nav {
}
.footer__nav {
    margin-right: auto;
    align-self: center;
}
.nav__items {
}
.footer__nav .nav__link:not(:last-child) {
    margin-right: 25px;
}
.footer__contacts {
}
.footer__contact-us:hover{
    text-decoration: none;
}
.footer__contact-us {
    font-size: 15px;
    align-self: center;
}
.footer__contacts-contacts {
    font-size: 14px;
    color:rgba(0,0,0, .4)
}
.footer__contacts-item {
    margin-bottom: 3px;
}
.footer__bottom {
    display: flex;
    justify-content: space-between;
}
.footer__addits {
    font-size: 12px;
    color:rgba(0,0,0, .4)
}
.footer__policy {
    color:rgba(0,0,0, .4);
    margin-bottom: 3px;
    display: block;
    transition: all .1s linear;
}
.footer__policy:hover{
    color:var(--secondary);
}
.footer__copyright {
}
.footer_disabled .footer{
    display: none;
}
.footer_disabled .chat__chat-items {
    height: calc(100vh - 260px);
}
</style>
