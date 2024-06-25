import { createRouter, createWebHistory } from 'vue-router'


const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import(/* webpackChunkName: "home" */ '../views/HomeView.vue')
  },
  {
    path: '/about',
    name: 'about',
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  },
  {
    path: '/student',
    name: 'student',
    component: () => import(/* webpackChunkName: "student" */ '../views/StudentView.vue')
  },
  {
    path: '/student-add',
    name: 'student-add',
    component: () => import(/* webpackChunkName: "student-add" */ '../views/StudentFormView.vue')
  },
  {
    path: '/student-edit/:id',
    name: 'student-edit',
    component: () => import(/* webpackChunkName: "student-edit" */ '../views/StudentEditFormView.vue')
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
