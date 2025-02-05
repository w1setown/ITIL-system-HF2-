<template>
  <div>
    <AppHeader />
    <KnowLedgeBase />
  </div>
</template>

<script>
import AppHeader from "@/components/AppHeader.vue"; 
import KnowLedgeBase from "@/components/KnowLedgeBase.vue";

export default {
  components: {
    AppHeader,
    KnowLedgeBase
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
