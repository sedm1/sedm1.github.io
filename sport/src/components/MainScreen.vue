<template>
    <section class="main">
        <div class="container">
            <div class="main__text">
                <h1 class="main__title">Спортивный центр <br/><span>I Love Sport </span><br/>в Санкт-Петербурге</h1>
                <p class="main__descript">Санкт-Петербургская классическая гимназия № 777 — это школа, известная в городе тем, что там с особой изощренностью истязают учеников. Гимназисты изучают два древних языка (латынь и греческий) и два новых (английский и немецкий), а кроме того постоянно находятся под гнетом суровой математики.</p>
                <button class="main__button">Записаться на пробное занятие</button>
            </div>
            <div class="main__img"><img src="@/assets/img/main.jpg" alt="main"></div>
        </div>
    </section>
</template>
<script>
export default {
    name: "MainScreen"
}
</script>
<style lang="sass" scoped>
@import "@/assets/sass/main.sass"
.container
    +flexa 
    justify-content: space-between
.main
    margin-top: 100px
    &__text
        max-width: 555px
    &__title
        margin-bottom: 40px
        span
            color: $pink
    &__descript
        margin-bottom: 64px
    &__button
        background: $pink
        color: $white
        padding: 20px 40px
        font-size: 18px
        font-weight: 500
        border-radius: 15px
        letter-spacing: 0.02em
    &__img
        max-width: 457px
        border-radius: 15px
        img
            border-radius: 15px
</style>