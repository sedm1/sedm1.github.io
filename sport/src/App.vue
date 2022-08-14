<template>
  <router-view/>
</template>

<style lang="sass">
@import "@/assets/sass/main.sass"
*
    font-family: 'Montserrat', sans-serif
    font-weight: 500
    padding: 0
    margin: 0
    box-sizing: border-box
a, button
    border: 0 none
    outline: 0 none
    color: inherit
    font-family: inherit
    text-decoration: none
    cursor: pointer
li, ol
    list-style: none 
.menu
    +flexa 
section
    margin-top: 100px
    &:first-child
        margin-top: 0px
.container
    max-width: 1140px
    width: 100%
    margin: 0 auto
img
    width: 100%
    height: auto
    display: block
span
    color: inherit
    font-size: inherit
    font-family: inherit
    font-weight: inherit
h1
    font-size: 48px
    font-weight: 600
    color: $black
    line-height: 64px
p 
    font-weight: 400
    font-size: 18px
    letter-spacing: 0.02em
    color: $blackGray
</style>
