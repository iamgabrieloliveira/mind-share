import { isAuthenticated } from '../../api/auth/check.ts';
import { NavigationGuardNext, RouteLocationNormalized } from 'vue-router';

const redirectIfAuthenticated = async (
  _: RouteLocationNormalized,
  __: RouteLocationNormalized,
  next: NavigationGuardNext
) => {
  return await isAuthenticated()
    ? next({ name: 'feed' })
    : next();
}

export { redirectIfAuthenticated };