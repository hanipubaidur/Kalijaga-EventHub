import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import EventView from '@/views/EventView.vue'
import BuatEvent from '@/views/BuatEvent.vue'
import RegisterView from '@/views/RegisterView.vue'
import EventDetail from '@/views/EventDetail.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView,
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
    },
    {
      path: '/event',
      name: 'event',
      component: EventView,
    },
    {
      path: '/buat',
      name: 'buat',
      component: BuatEvent,
    },
    {
      path: '/event/:id',
      name: 'event-detail',
      component: EventDetail,
      props: true, // penting supaya id dikirim sebagai prop
    },
  ],
})

// Guard: cek token
router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token')

  if (!token && to.name !== 'login' && to.name !== 'register') {
    next({ name: 'login' }) // arahkan ke login kalau tidak punya token
  } else if (token && (to.name === 'login' || to.name === 'register')) {
    next({ name: 'home' }) // kalau sudah login, tidak boleh ke login/register
  } else {
    next() // lanjut
  }
})

export default router
