<template>
    <div>
      <h2>Ticket Details</h2>
      <RoleSelector v-model="selectedRole" />
      <div v-if="ticket">
        <div v-if="isEditableRole">
          <div>
            <label for="title">Title:</label>
            <input type="text" v-model="ticket.title">
          </div>
          <div>
            <label for="description">Description:</label>
            <textarea v-model="ticket.description"></textarea>
          </div>
          <div>
            <label for="tstatus">Status:</label>
            <select v-model="ticket.tstatus">
              <option value="new">New</option>
              <option value="open">Open</option>
              <option value="pending">Pending</option>
              <option value="on-hold">On-Hold</option>
              <option value="solved">Solved</option>
            </select>
          </div>
          <div>
            <label for="priority">Priority:</label>
            <select v-model="ticket.priority">
              <option value="low">Low</option>
              <option value="medium">Medium</option>
              <option value="high">High</option>
            </select>
          </div>
          <button @click="saveTicket">Save Changes</button>
        </div>
        <div v-else>
          <h3>{{ ticket.title }}</h3>
          <p>{{ ticket.description }}</p>
          <p>Status: {{ ticket.tstatus }}</p>
          <p>Priority: {{ ticket.priority }}</p>
          <p>Last update: {{ ticket.created_at }}</p>
        </div>
      </div>
      <div v-else>
        <p>Loading...</p>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import RoleSelector from '@/components/RoleSelector.vue';
  
  export default {
    name: 'TicketDetails',
    components: {
      RoleSelector
    },
    data() {
      return {
        ticket: null,
        selectedRole: 'customer'
      };
    },
    computed: {
      isEditableRole() {
        return ['admin', 'sd_level1', 'sd_level2', 'sd_level3', 'sd_temp'].includes(this.selectedRole);
      }
    },
    mounted() {
      this.fetchTicket();
    },
    methods: {
      fetchTicket() {
        const ticketId = this.$route.params.id;
        axios.get(`http://localhost/ITIL-system-HF2-/backend/tickets.php?id=${ticketId}`)
          .then(response => {
            this.ticket = response.data;
          })
          .catch(error => {
            console.error("Error fetching ticket:", error.response ? error.response.data : error.message);
          });
      },
      saveTicket() {
        axios.post(`http://localhost/ITIL-system-HF2-/backend/update_ticket.php`, this.ticket)
          .then(response => {
            if (response.data.success) {
              alert('Ticket updated successfully');
            } else {
              console.error("Error updating ticket:", response.data.error);
            }
          })
          .catch(error => {
            console.error("Error updating ticket:", error.response ? error.response.data : error.message);
          });
      }
    }
  }
  </script>