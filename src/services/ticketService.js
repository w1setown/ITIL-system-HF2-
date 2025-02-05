import axios from 'axios';

const API_BASE_URL = 'http://localhost/ITIL-system-HF2-/backend';

export const fetchTickets = () => 
  axios.get(`${API_BASE_URL}/tickets.php`)
    .then(response => response.data.data || []);

export const fetchTicket = (id) => 
  axios.get(`${API_BASE_URL}/tickets.php?id=${id}`)
    .then(response => response.data.data);

export const createTicket = (ticket) => 
  axios.post(`${API_BASE_URL}/tickets.php`, {
    action: 'create',
    ...ticket
  }).then(response => response.data);

export const updateTicket = (ticket) => 
  axios.post(`${API_BASE_URL}/tickets.php`, {
    action: 'update',
    ...ticket
  }).then(response => response.data);

export const deleteTicket = (id) => 
  axios.post(`${API_BASE_URL}/tickets.php`, {
    action: 'delete',
    id
  }).then(response => response.data);