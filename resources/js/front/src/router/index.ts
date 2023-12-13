import { createRouter, createWebHashHistory, RouteRecordRaw } from 'vue-router';

import Login from '../pages/Login.vue';
import Register from '../pages/Register.vue';
import NotFound from '../pages/NotFound.vue';
import Feed from '../pages/Feed.vue';
import CreateIdeaForm from '../pages/CreateIdeaForm.vue';
import IdeaView from '../pages/IdeaView.vue';

import { redirectIfAuthenticated } from './middlewares';

const routes: RouteRecordRaw[] = [
  { name: 'login', path: '/login', component: Login, beforeEnter: redirectIfAuthenticated },
  { name: 'register', path: '/register', component: Register },

  { name: 'feed', path: '/', component: Feed },
  { name: 'create-idea', path: '/new-idea', component: CreateIdeaForm },
  { name: 'idea', path: '/idea/:id', component: IdeaView },

  { name: 'not-found', path: '/:pathMatch(.*)*', component: NotFound },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export { router };