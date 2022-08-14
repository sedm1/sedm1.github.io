<template>
    <section class="about">
        <div class="container">
            <h1 class="about__title">О нас</h1>
            <p class="about__descript">Спортивный клуб "I Love sport" - молодой, но очень перспективный клуб.<br/>Основан в 2016 году. Мы делаем детский спорт более доступным и интересным.<br/>Наши педагоги являются профессионалами своего дела, имеют высшее образование и постоянно повышают свою квалификацию. Относимся с большой любовью к детям и к своей работе. Ждем вас в нашу дружелюбную команду!</p>
        </div>
    </section>
</template>
<script>
export default {
    name: "About"
}
</script>
<style lang="sass" scoped>
@import "@/assets/sass/main.sass"
.about
    padding: 100px 0px
    background: $lightGray
    margin-top: 100px
    &__title
        margin-bottom: 40px
</style>