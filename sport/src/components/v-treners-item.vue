<template>
    <div class="treners__item">
        <div class="treners__item-img"><img :src="require(`@/assets/img/${treners__data.image}`)" alt="trenersImg"></div>
        <div 
        class="treners__item-dignity"
        v-if="treners__data.dignity"
        >{{treners__data.dignity}}</div>
        <h2 class="treners__item-name">{{treners__data.name}}</h2>
        <div class="treners__item-line"></div> 
        <p class="treners__item-programm">{{treners__data.programm}}</p>
    </div>
</template>
<script>
export default {
    name: "VTrenersItem",
    props:{
        treners__data:{
            type: Object,
            default(){
                return {}
            }
        }
    }
}
</script>
<style lang="sass" scoped>
@import "@/assets/sass/main.sass"
.treners__item
    padding: 32px
    background: $white
    border-radius: 15px
    text-align: center
    max-width: 360px
    width: 100%
    &-img
        width: 120px
        height: 120px
        border-radius: 100%
        margin: 0 auto
        img
            border-radius: 100%
            height: 120px
    &-dignity
        margin-top: 12px
        font-size: 16px
        font-weight: 300
        text-transform: uppercase
        letter-spacing: 0.02em 
    &-name
        font-weight: 500
        font-size: 18px
        letter-spacing: 0.02em 
        margin-top: 8px
    &-line
        margin: 12px auto
        width: 24px
        height: 2px
        background: $pink
    &-programm
        font-size: 18px
        font-weight: 400
        letter-spacing: 0.02em 
        line-height: 28px

</style>