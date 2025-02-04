<template>
    <form @submit.prevent="handleSubmit">
      <div>
        <label for="title">Title:</label>
        <input type="text" v-model="localTicket.title" required>
      </div>
      <div>
        <label for="description">Description:</label>
        <textarea v-model="localTicket.description" required></textarea>
      </div>
      <div>
        <label for="tstatus">Status:</label>
        <select v-model="localTicket.tstatus" required>
          <option value="new">New</option>
          <option value="open">Open</option>
          <option value="pending">Pending</option>
          <option value="on-hold">On-Hold</option>
          <option value="solved">Solved</option>
        </select>
      </div>
      <div>
        <label for="priority">Priority:</label>
        <select v-model="localTicket.priority" required>
          <option value="low">Low</option>
          <option value="medium">Medium</option>
          <option value="high">High</option>
        </select>
      </div>
      <button type="submit">{{ submitButtonText }}</button>
    </form>
  </template>
  
  <script>
  export default {
    name: 'TicketForm',
    props: {
      ticket: {
        type: Object,
        required: true
      },
      submitButtonText: {
        type: String,
        default: 'Submit'
      }
    },
    data() {
      return {
        localTicket: { ...this.ticket }
      };
    },
    watch: {
      ticket: {
        handler(newTicket) {
          this.localTicket = { ...newTicket };
        },
        deep: true
      }
    },
    methods: {
      handleSubmit() {
        this.$emit('submit', this.localTicket);
      }
    }
  }
  </script>
  
  <style scoped>
  form {
    margin-bottom: 20px;
  }
  form div {
    margin-bottom: 10px;
  }
  </style>