import { client } from '../../http/client.ts';

type TLoginPayload = {
  email: string,
  password: string,
}

type TResponse = {
  user: {
    id: string,
    name: string,
  },
}

const login = async (payload: TLoginPayload) => {
  const response = await client.post('api/auth/login', payload);

  return response.data as TResponse;
};

export { login };
