<template>
  <div>
    <KnowLedgeBase />
    <nav>
      <router-link to="/">Knowledge Base</router-link>
      <router-link to="/tickets">Ticket System</router-link>
    </nav>
    <router-view />
  </div>
</template>

<script>
import KnowLedgeBase from "@/components/KnowLedgeBase.vue";

export default {
  components: {
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
