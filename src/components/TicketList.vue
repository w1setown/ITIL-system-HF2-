<template>
    <div>
      <h2>TicketList</h2>
      <RoleSelector v-model="selectedRole" />
      <form v-if="selectedRole !== 'customer'" @submit.prevent="createTicket">
        <div>
          <label for="title">Title:</label>
          <input type="text" v-model="newTicket.title" required>
        </div>
        <div>
          <label for="description">Description:</label>
          <textarea v-model="newTicket.description" required></textarea>
        </div>
        <div>
          <label for="tstatus">Status:</label>
          <select v-model="newTicket.tstatus" required>
            <option value="new">New</option>
            <option value="open">Open</option>
            <option value="pending">Pending</option>
            <option value="on-hold">On-Hold</option>
            <option value="solved">Solved</option>
          </select>
        </div>
        <div>
          <label for="priority">Priority:</label>
          <select v-model="newTicket.priority" required>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
          </select>
        </div>
        <button type="submit">Create Ticket</button>
      </form>
      <ul>
        <li v-for="ticket in tickets" :key="ticket.id" @click="viewTicket(ticket.id)">
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
  
  export default {
    name: 'TicketList',
    components: {
      RoleSelector
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
      createTicket() {
        axios.post('http://localhost/ITIL-system-HF2-/backend/create_ticket.php', this.newTicket)
          .then(response => {
            if (response.data.success) {
              this.tickets.push({
                ...this.newTicket,
                id: response.data.id,
                created_at: new Date().toISOString()
              });
              this.newTicket = {
                title: '',
                description: '',
                tstatus: 'new',
                priority: 'low'
              };
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
  form {
    margin-bottom: 20px;
  }
  form div {
    margin-bottom: 10px;
  }
  </style>