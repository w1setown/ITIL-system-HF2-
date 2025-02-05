<template>
    <div>
      <h1>{{ title }}</h1>
      <div v-if="content.length">
        <!-- Loop thru content and displaty it -->
        <div v-for="(item, index) in visibleContent" :key="index">
          <h2>{{ item.title }}</h2>
          <p>{{ item.content }}</p>
        </div>

        <button v-if="visibleCount < content.length" @click="loadMore">Indlæs flere</button>
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
              visibleCount: 5
          };
      },
      computed: {
          visibleContent() {
              return this.content.slice(0, this.visibleCount);
          }
      },
      methods: {
          loadMore() {
              this.visibleCount += 5;
          }
      },
      mounted() {
        axios.get('http://localhost/ITIL-system-HF2-/backend/knowledgebase.php')
          .then(response => {
              console.log(response.data); // check  data
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
  