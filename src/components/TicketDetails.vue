<template>
  <div>
    <h2>Ticket Details</h2>
    <div v-if="loading">Loading...</div>
    <div v-else-if="ticket">
      <ticket-form 
        v-if="isEditableUser" 
        :ticket="ticket" 
        submit-button-text="Save Changes" 
        @submit="saveTicket" 
      />
      <div v-else>
        <h3>{{ ticket.title }}</h3>
        <p>{{ ticket.description }}</p>
        <p>Status: {{ ticket.tstatus }}</p>
        <p>Priority: {{ ticket.priority }}</p>
        <p>Last update: {{ ticket.created_at }}</p>
      </div>
      <button v-if="isEditableUser" @click="deleteTicket">Delete Ticket</button>
    </div>
    <div v-else>Ticket not found</div>
  </div>
</template>

<script>
import { fetchTicket, updateTicket, deleteTicket } from '@/services/ticketService';
import TicketForm from '@/components/TicketForm.vue';
import CommentList from './CommentList.vue';

export default {
  name: 'TicketDetails',
  components: { TicketForm },
  props: {
    selectedUser: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      ticket: null,
      loading: true,
      error: null
    };
  },
  computed: {
    isEditableUser() {
      return ['admin', 'sd_level1', 'sd_level2', 'sd_level3', 'sd_temp'].includes(this.selectedUser);
    }
  },
  async mounted() {
    await this.fetchTicket();
  },
  methods: {
    async fetchTicket() {
      this.loading = true;
      try {
        this.ticket = await fetchTicket(this.$route.params.id);
      } catch (error) {
        this.error = error.message;
      } finally {
        this.loading = false;
      }
    },
    async saveTicket(ticket) {
      try {
        await updateTicket(ticket);
        await this.fetchTicket();
      } catch (error) {
        this.error = error.message;
      }
    },
    async deleteTicket() {
      if (!confirm('Are you sure you want to delete this ticket?')) return;
      try {
        await deleteTicket(this.ticket.id);
        this.$router.push({ name: 'TicketList' });
      } catch (error) {
        this.error = error.message;
      }
    }
  }
};
</script>
