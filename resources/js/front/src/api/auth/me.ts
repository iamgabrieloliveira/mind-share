import { client } from '../../http/client.ts';

type IResponse = {
  user: { id: string, name: string }
}

const me = async () => {
  const response = await client.get('api/me');
  return response.data as IResponse;
}

export { me };
