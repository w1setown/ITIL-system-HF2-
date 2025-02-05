<template>
    <div>
      <h3>Comments</h3>
      <div v-if="comments.length > 0">
        <div v-for="comment in comments" :key="comment.id" class="comment">
          <strong>{{ comment.username }}</strong>
          <p>{{ comment.tcomment }}</p>
          <small>{{ formatDate(comment.created_at) }}</small>
        </div>
      </div>
      <div v-else>
        <p>No comments yet.</p>
      </div>
  
      <!-- Add Comment Form -->
      <form @submit.prevent="submitComment">
        <textarea v-model="newComment" placeholder="Write a comment..." required></textarea>
        <button type="submit">Add Comment</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    props: {
      ticketId: Number,
      userId: Number
    },
    data() {
      return {
        comments: [],
        newComment: ""
      };
    },
    mounted() {
      this.fetchComments();
    },
    methods: {
      fetchComments() {
        axios.get(`http://localhost/ITIL-system-HF2-/backend/tickets.php?id=${this.ticketId}`)
          .then(response => {
            this.comments = response.data.comments;
          })
          .catch(error => console.error("Error fetching comments:", error));
      },
      submitComment() {
        if (!this.newComment.trim()) return;
  
        axios.post('http://localhost/ITIL-system-HF2-/backend/add_comment.php', {
          ticket_id: this.ticketId,
          user_id: this.userId,
          tcomment: this.newComment
        }).then(response => {
          if (response.data.success) {
            this.fetchComments();
            this.newComment = "";
          }
        }).catch(error => console.error("Error adding comment:", error));
      },
      formatDate(dateString) {
        return new Date(dateString).toLocaleString();
      }
    }
  };
  </script>
  
  <style scoped>
  .comment {
    display: flex;
    flex-direction: column;
    margin: auto;
    align-content: center;
    width: 70%;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    background-color: #fff;
    gap: 15px;
  }

  .comment strong {
    position: relative;
    font-size: 1.2em;
  }
  
  textarea {
    width: 100%;
    padding: 10px;
    border: 10px solid #ddd;
    border-radius: 4px;
  }
  
  button {
    margin-top: 10px;
    padding: 8px 15px;
    border: none;
    background-color: #ddd;
    color: #000;
    border-radius: 4px;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #ccc;
  }
  </style>
  