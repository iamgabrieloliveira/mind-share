import { client } from '../../http/client.ts';

const logout = async (): Promise<void> => {
    await client.post('api/auth/logout');
};

export { logout };