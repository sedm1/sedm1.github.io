<template>
    <section class="treners">
        <div class="container">
            <h1 class="treners__title">Наши тренеры</h1>
            <div class="treners__block">
                <VTrenersItem
                v-for="trener in TRENERS"
                :key="trener.id"
                :treners__data = "trener"
                ></VTrenersItem>
            </div>
        </div>
    </section>
</template>
<script>
import { mapGetters, mapActions } from 'vuex';
import VTrenersItem from './v-treners-item.vue';
export default {
    name: "Treners",
    methods: {
        ...mapActions([
            "GET_TRENERS_FROM_DB"
        ])
    },
    computed: {
        ...mapGetters([
            "TRENERS"
        ])
    },
    mounted() {
        this.GET_TRENERS_FROM_DB();
    },
    components: { VTrenersItem }
}
</script>
<style lang="sass" scoped>
@import "@/assets/sass/main.sass"
.treners
    margin-top: 0px
    padding-top: 100px
    background: $lightGray
    &__block
        display: flex
        justify-content: space-between
    &__title
        margin-bottom: 40px
</style>