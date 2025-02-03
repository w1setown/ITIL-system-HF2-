<template>
    <div>
      <label for="role">Select Role:</label>
      <select :value="modelValue" @change="updateRole($event.target.value)">
        <option value="admin">Admin</option>
        <option value="sd_level1">SD Level 1</option>
        <option value="sd_level2">SD Level 2</option>
        <option value="sd_level3">SD Level 3</option>
        <option value="sd_temp">SD Temp</option>
        <option value="customer">Customer</option>
      </select>
    </div>
  </template>
  
  <script>
  export default {
    name: 'RoleSelector',
    props: {
      modelValue: {
        type: String,
        required: true
      }
    },
    methods: {
      updateRole(value) {
        this.$emit('update:modelValue', value);
      }
    }
  }
  </script>