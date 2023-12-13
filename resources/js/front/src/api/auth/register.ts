import { client } from '../../http/client.ts';

type TLoginPayload = {
  name: string,
  email: string,
  password: string,
  password_confirmation: string,
}

const register = async (payload: TLoginPayload): Promise<string> => {
  const response = await client.post('api/auth/register', payload);
  return response.data.token;
};

export { register };