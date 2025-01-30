<template>
    <header>
        <h1>My Website</h1>
        <nav>
            <ul>
                <li v-for="link in links" :key="link.text"> 
                    <a :href="link.url">{{ link.text }}</a>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'HeaderApp',
    data() {
        return {
            links: [
                { text: 'Home', url: '/' },
                { text: 'Very cool place', url: 'https://github.com/w1setown/ITIL-system-HF2-' },
                { text: 'VERY cool photo', url: 'https://tenor.com/da/view/tony-stark-jarvis-gif-22373764' }
            ]
        };
    }
};
</script>


<style scoped>
header {
  background-color: #f8f9fa;
  padding: 20px;
  text-align: center;
}

nav ul {
  list-style-type: none;
  padding: 0;
}

nav ul li {
  display: inline;
  margin: 0 15px;
}
</style>