<template>
  <div class="container">
    <h1>{{ title }}</h1>
    <div v-if="content.length">
      <div class="content-list">
        <div v-for="(item, index) in visibleContent" :key="index" class="content-box">
          <h2>{{ item.title }}</h2>
          <p>{{ item.content }}</p>
        </div>
      </div>
      <button v-if="visibleCount < content.length" @click="loadMore" class="load-more-btn">Indlæs flere</button>
    </div>
    <div v-else>
      <p>No content available</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            title: '',
            content: [],
            visibleCount: 3
        };
    },
    computed: {
        visibleContent() {
            return this.content.slice(0, this.visibleCount);
        }
    },
    methods: {
        loadMore() {
            this.visibleCount += 3;
        }
    },
    mounted() {
      axios.get('http://localhost/ITIL-system-HF2-/backend/knowledgebase.php')
        .then(response => {
            console.log(response.data);
            this.title = response.data.title || "FAQ";
            this.content = Array.isArray(response.data.content) ? [...response.data.content] : [];
            console.log("Content fetched:", this.content);
        })
        .catch(error => {
            console.error("Error fetching data:", error.response ? error.response.data : error.message);
            this.content = []; 
        });
    }
};
</script>

<style scoped>
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

h1 {
  text-align: center;
  margin-bottom: 20px;
}

.content-list {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.content-box {
  width: 100%;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  background-color: #fff;
}

h2 {
  font-size: 1.5rem;
  margin-bottom: 10px;
}

p {
  font-size: 1rem;
  color: #555;
}

.load-more-btn {
  display: block;
  margin: 20px auto;
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.load-more-btn:hover {
  background-color: #0056b3;
}
</style>
