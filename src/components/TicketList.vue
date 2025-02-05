<template>
    <div>
      <h2>TicketList</h2>
      <RoleSelector v-model="selectedRole" />
      <ticket-form v-if="selectedRole !== 'customer'" :ticket="newTicket" submit-button-text="Create Ticket" @submit="createTicket" />
      <ul>
        <li v-for="ticket in sortedTickets" :key="ticket.id" @click="viewTicket(ticket.id)">
          <h3>{{ ticket.title }}</h3>
          <p>Status: {{ ticket.tstatus }}</p>
          <p>Priority: {{ ticket.priority }}</p>
          <p>Last update: {{ ticket.created_at }}</p>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import RoleSelector from '@/components/RoleSelector.vue';
  import TicketForm from '@/components/TicketForm.vue';
  
  export default {
    name: 'TicketList',
    components: {
      RoleSelector,
      TicketForm
    },
    data() {
      return {
        tickets: [],
        newTicket: {
          title: '',
          description: '',
          tstatus: 'new',
          priority: 'low'
        },
        selectedRole: 'customer'
      };
    },
    computed: {
      sortedTickets() {
        const priorityOrder = { high: 1, medium: 2, low: 3 };
        return this.tickets.slice().sort((a, b) => priorityOrder[a.priority] - priorityOrder[b.priority]);
      }
    },
    mounted() {
      this.fetchTickets();
    },
    methods: {
      fetchTickets() {
        axios.get('http://localhost/ITIL-system-HF2-/backend/tickets.php')
          .then(response => {
            this.tickets = response.data;
          })
          .catch(error => {
            console.error("Error fetching tickets:", error.response ? error.response.data : error.message);
          });
      },
      createTicket(ticket) {
        axios.post('http://localhost/ITIL-system-HF2-/backend/create_ticket.php', ticket)
          .then(response => {
            if (response.data.success) {
              this.tickets.push({
                ...ticket,
                id: response.data.id,
                created_at: new Date().toISOString()
              });
              this.newTicket = {
                title: '',
                description: '',
                tstatus: 'new',
                priority: 'low'
              };
              this.tickets = this.sortedTickets;
            } else {
              console.error("Error creating ticket:", response.data.error);
            }
          })
          .catch(error => {
            console.error("Error creating ticket:", error.response ? error.response.data : error.message);
          });
      },
      viewTicket(ticketId) {
        this.$router.push({ name: 'TicketDetails', params: { id: ticketId } });
      }
    }
  }
  </script>
  
  <style scoped>
  ul {
    list-style-type: none;
    padding: 0;
  }
  li {
    margin-bottom: 20px;
    border: 1px solid #ccc;
    padding: 10px;
    cursor: pointer;
  }
  </style>