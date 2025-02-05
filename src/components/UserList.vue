<template>
    <div>
      <h2>User List</h2>
      <ul>
        <li v-for="user in users" :key="user.id">{{ user.name }}</li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
      data() {
          return {
              users: []
          };
      },
      mounted() {
          axios.get('http://localhost/ITIL-system-HF2-/backend/users.php')
          .then(response => {
              this.users = response.data;
          })
          .catch(error => {
              console.error("Der var et irriterende problem", error);
          });
      }
  };
  </script>
  
  <style scoped>
  ul{
    list-style: none;
  }
  </style>
  