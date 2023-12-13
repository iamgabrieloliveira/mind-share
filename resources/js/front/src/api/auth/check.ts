import { client } from '../../http/client.ts';
import { store } from '../../store.ts';

const isAuthenticated = async (): Promise<boolean> => {
  try {
    const response = await client.get('api/auth/check');
    store.user = response.data.user;

    return true;
  } catch (e) {
    return false;
  }
};

export { isAuthenticated };