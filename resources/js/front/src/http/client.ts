import axios from 'axios';
import { injectSocketId } from './interceptors';

const client = axios.create({
  baseURL: import.meta.env.VITE_SERVER_URL,
  withCredentials: true,
});

client.interceptors.request.use(injectSocketId);

export { client };