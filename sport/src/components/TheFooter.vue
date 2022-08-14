<template>
    <footer>
        <div class="container">
            <div class="footer__logo">LOGOTYPE</div>
            <div class="copy">© Copyright 2019 - 2021</div>
        </div>
    </footer>
</template>
<script>
export default {
    name: "Footer"
}
</script>
<style lang="sass" scoped>
@import "@/assets/sass/main.sass"
footer
    margin-top: 100px
    background: $blackGray
    padding: 106px 0px
.container
    +flexa 
    justify-content: space-between
.footer__logo
    color: $white
    text-transform: uppercase
    font-size: 24px
    font-weight: 600
.copy
    font-size: 16px
    font-weight: 400
    color: $white
    letter-spacing: 0.02em
</style>