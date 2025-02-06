<template>
  <div>
    <KnowLedgeBase />
    <nav>
      <router-link to="/">Knowledge Base</router-link>
      <router-link to="/tickets">Ticket System</router-link>
    </nav>
    <UserSelector v-model="selectedUser" />
    <router-view :selected-user="selectedUser" />
  </div>
</template>
  
<script>
import KnowLedgeBase from "@/components/KnowLedgeBase.vue";
import UserSelector from "@/components/UserSelector.vue";

export default {
  components: {
    KnowLedgeBase,
    UserSelector
  },
  data() {
    return {
      selectedUser: 'customer'
    };
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

nav {
  display: flex;
  justify-content: center;
  gap: 2px;
  position: relative;
  font-family: Arial, Helvetica, sans-serif;
  text-decoration: none;
}

nav a {
  text-decoration: none;
  color: #2c3e50;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 20px;
}


nav a:hover {
  transform: translateY(-2px);
}

</style>