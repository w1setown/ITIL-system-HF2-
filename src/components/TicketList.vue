<template>
  <div>
    <h2>TicketList</h2>
    <ticket-form 
      v-if="selectedUser !== 'customer'" 
      :ticket="emptyTicket" 
      submit-button-text="Create Ticket" 
      @submit="createTicket" 
    />
    <ul>
      <li v-for="ticket in sortedTickets" 
          :key="ticket.id" 
          @click="viewTicket(ticket.id)">
        <h3>{{ ticket.title }}</h3>
        <p>Status: {{ ticket.tstatus }}</p>
        <p>Priority: {{ ticket.priority }}</p>
        <p>Last update: {{ ticket.created_at }}</p>
      </li>
    </ul>
  </div>
</template>

<script>
import { fetchTickets, createTicket } from '@/services/ticketService';
import TicketForm from '@/components/TicketForm.vue';

export default {
  name: 'TicketList',
  components: { TicketForm },
  props: {
    selectedUser: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      tickets: [],
      emptyTicket: {
        title: '',
        description: '',
        tstatus: 'new',
        priority: 'low'
      }
    };
  },
  computed: {
    sortedTickets() {
      const priorityOrder = { high: 1, medium: 2, low: 3 };
      return [...this.tickets].sort((a, b) => priorityOrder[a.priority] - priorityOrder[b.priority]);
    }
  },
  mounted() {
    this.fetchTickets();
  },
  methods: {
    async fetchTickets() {
      try {
        this.tickets = await fetchTickets();
      } catch (error) {
        console.error("Error fetching tickets:", error);
        this.tickets = [];
      }
    },
    async createTicket(ticket) {
      try {
        await createTicket(ticket);
        await this.fetchTickets();
      } catch (error) {
        console.error("Error creating ticket:", error);
      }
    },
    viewTicket(ticketId) {
      this.$router.push({ name: 'TicketDetails', params: { id: ticketId } });
    }
  }
};
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