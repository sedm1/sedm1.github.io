<template>
    <section class="napr">
        <div class="container">
            <h1 class="napr__title">Направления</h1>
            <div class="napr__block">
                <VNaprItem 
                v-for="NaprItem in NAPRAVLENIA" 
                :key="NaprItem.id"
                :napr__data="NaprItem"
                ></VNaprItem>
            </div>
        </div>
    </section>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
import VNaprItem from './v-napr-item.vue';
export default {
    name: "Napravlenia",
    computed: {
        ...mapGetters(["NAPRAVLENIA"])
    },
    methods: {
        ...mapActions(["GET_NAPRAVLENIA_FROM_DB"])
    },
    mounted() {
        this.GET_NAPRAVLENIA_FROM_DB();
    },
    components: { VNaprItem }
}
</script>
<style lang="sass" scoped>
@import "@/assets/sass/main.sass"
.napr
    background: $lightGray
    margin-top: 0px
    padding-top: 100px
    &__title
        margin-bottom: 40px
    &__block
        display: flex
        flex-wrap: wrap
        justify-content: space-between
</style>