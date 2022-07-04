import App from './components/App'
import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import Dashboard from './components/Dashboard.vue'
import Profile from './components/Profile.vue'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/dashboard',
      component: Dashboard,
      name: 'dashboard',
      meta: {
          title: 'Dashboard'
      },
    },
    {
      path: '/profile',
      component: Profile,
      name: 'profile',
      meta: {
          title: 'Profile'
      },
    },
  ],
});

const app = createApp({
    components: {
        App
      }
});

app.use(router)
app.mount('#app');