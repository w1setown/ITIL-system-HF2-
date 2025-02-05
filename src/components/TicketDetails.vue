<template>
    <div>
      <h2>Ticket Details</h2>
      <RoleSelector v-model="selectedRole" />
      <div v-if="ticket">
        <ticket-form v-if="isEditableRole" :ticket="ticket" submit-button-text="Save Changes" @submit="saveTicket" />
        <div v-else>
          <h3>{{ ticket.title }}</h3>
          <p>{{ ticket.description }}</p>
          <p>Status: {{ ticket.tstatus }}</p>
          <p>Priority: {{ ticket.priority }}</p>
          <p>Last update: {{ ticket.created_at }}</p>
        </div>
        <div v-if="isEditableRole">
          <button @click="confirmDelete">Delete Ticket</button>
        </div>
        <CommentList :ticket-id="ticket.id" :user-id="userId" />
      </div>
      <div v-else>
        <p>Loading...</p>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import RoleSelector from '@/components/RoleSelector.vue';
  import TicketForm from '@/components/TicketForm.vue';
  import CommentList from '@/components/CommentList.vue';
  
  export default {
    name: 'TicketDetails',
    components: {
      RoleSelector,
      TicketForm,
      CommentList
    },
    data() {
      return {
        userId: 1, // Hardcoded user ID for now
        ticket: null,
        selectedRole: 'customer' // Default role
      };
    },
    computed: {
      isEditableRole() {
        return ['admin', 'sd_level1', 'sd_level2', 'sd_level3', 'sd_temp'].includes(this.selectedRole);
      }
    },
    mounted() {
      this.fetchTicket();
      this.fetchUsers
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
      saveTicket(ticket) {
        axios.post(`http://localhost/ITIL-system-HF2-/backend/update_ticket.php`, ticket)
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
      },
      confirmDelete() {
        if (confirm('Are you sure you want to delete this ticket?')) {
          this.deleteTicket();
        }
      },
      deleteTicket() {
        const ticketId = this.ticket.id;
        axios.post(`http://localhost/ITIL-system-HF2-/backend/delete_ticket.php`, { id: ticketId })
          .then(response => {
            if (response.data.success) {
              alert('Ticket deleted successfully');
              this.$router.push({ name: 'TicketList' });
            } else {
              console.error("Error deleting ticket:", response.data.error);
            }
          })
          .catch(error => {
            console.error("Error deleting ticket:", error.response ? error.response.data : error.message);
          });
      }
    }
  }
  </script>
  