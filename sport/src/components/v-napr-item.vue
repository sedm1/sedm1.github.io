<template>
    <div class="napr__item">
        <div class="napr__item-img"><img :src="require(`@/assets/img/${napr__data.image}`)" alt="naprImg"></div>
        <div class="napr__item-info">
            <h2 class="napr__item-title">{{napr__data.title}}</h2>
            <p class="napr__item-description">{{napr__data.description}}</p>
            <div class="napr__item-footer">
                <div class="napr__item-price">от {{napr__data.price}} руб</div>
                <router-link class="napr__item-link" to="/">Открыть</router-link>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "VNaprItem",
    props: {
        napr__data:{
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
.napr__item
    max-width: 360px
    margin-bottom: 32px
    &-img
        width: 100%
        img
            border-radius: 15px 15px 0px 0px
            max-height: 120px
    &-info
        padding: 32px
        background: $white
        border-radius: 0px 0px 15px 15px
    &-title
        font-size: 18px
        font-weight: 500
        letter-spacing: 0.02em
    &-description
        font-size: 16px
        font-weight: 400
        margin-top: 8px
        text-overflow: ellipsis
        letter-spacing: 0.02em
        display: -webkit-box
        -webkit-line-clamp: 4
        -webkit-box-orient: vertical
        line-height: 24px
    &-footer
        +flexa 
        justify-content: space-between
        margin-top: 24px
    &-price
        font-weight: 500
        font-size: 18px
        letter-spacing: 0.02em
    &-link
        color: $pink
        letter-spacing: 0.02em
        font-weight: 500
        font-size: 18px
</style>