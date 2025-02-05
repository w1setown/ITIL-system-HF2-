<template>
  <div>
    <label for="user-selector">Select User:</label>
    <select 
      id="user-selector"
      name="user"
      :value="modelValue" 
      @change="updateRole($event.target.value)"
    >
      <option v-for="user in users" :key="user.id" :value="user.role">
        {{ user.username }} ({{ user.role }})
      </option>
    </select>
  </div>
</template>

<script>
import axios from 'axios';

export default {
name: 'RoleSelector',
props: {
  modelValue: {
    type: String,
    required: true
  }
},
data() {
  return {
    users: []
  };
},
methods: {
  updateRole(value) {
    this.$emit('update:modelValue', value);
  },
  fetchUsers() {
    axios.get('http://localhost/ITIL-system-HF2-/backend/users.php')
      .then(response => {
        this.users = response.data;
      })
      .catch(error => {
        console.error("Error fetching users:", error);
      });
  }
},
mounted() {
  this.fetchUsers();
}
}
</script>

<style scoped>
select {
padding: 5px;
margin: 5px;
border-radius: 4px;
}

label {
margin-right: 10px;
}
</style>