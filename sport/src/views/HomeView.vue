<template>
  <div>
    <TheHeader></TheHeader>
    <MainScreen></MainScreen>
    <About></About>
    <Napravlenia></Napravlenia>
    <Treners></Treners>
    <TheFooter></TheFooter>
  </div>
</template>

<script>
import TheHeader from '@/components/TheHeader.vue';
import MainScreen from '@/components/MainScreen.vue';
import About from '@/components/About.vue';
import Napravlenia from '@/components/Napravlenia.vue';
import Treners from '@/components/Treners.vue';
import TheFooter from '../components/TheFooter.vue';

export default {
    name: "HomeView",
    components: { TheHeader, MainScreen, About, Napravlenia, Treners, TheFooter }
}
</script>
<style lang="sass" >
</style>