import { createRouter, createWebHistory } from 'vue-router';
import KnowLedgeBase from '@/components/KnowLedgeBase.vue';
import TicketList from '@/components/TicketList.vue';
import TicketDetails from '@/components/TicketDetails.vue';

const routes = [
  {
    path: '/',
    name: 'KnowLedgeBase',
    component: KnowLedgeBase
  },
  {
    path: '/tickets',
    name: 'TicketList',
    component: TicketList
  },
  {
    path: '/tickets/:id',
    name: 'TicketDetails',
    component: TicketDetails
  }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});

export default router;  