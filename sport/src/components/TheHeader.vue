<template>
    <header>
        <div class="container">
            <ul class="menu">
                <li><a href="#">Главная</a></li>
                <li><a href="#">О нас</a></li>
                <li><a href="#">Расписание</a></li>
                <li><a href="#">Галерея</a></li>
                <li><a href="#">Новости</a></li>
                <li><a href="#">Контакты</a></li>
            </ul>
            <router-link to="/" class="login">L</router-link>
        </div>
    </header>
</template>
<script>
export default {
    name: "TheHeader"
}
</script>
<style lang="sass" scoped>
@import "@/assets/sass/main.sass"
header
    padding: 26px 0px
.container
    +flexa
    justify-content: flex-end
.login
    margin-left: 40px
    width: 48px
    height: 48px
    border-radius: 100%
    background: $pink
    +flexa 
    justify-content: center
.menu
    li
        margin-right: 40px
        font-size: 18px
        letter-spacing: 0.02em
        color: $blackGray
        transition: .3s
        &:hover
            color: $pink
        &:last-child
            margin-right: 0px

</style>