import { isAuthenticated } from '../../api/auth/check.ts';
import type { RouteLocationNormalized, NavigationGuardNext } from 'vue-router';

const auth = async (_: RouteLocationNormalized, __: RouteLocationNormalized, next: NavigationGuardNext) => {
  return await isAuthenticated()
    ? next()
    : next({ name: 'login' });
}

export { auth };