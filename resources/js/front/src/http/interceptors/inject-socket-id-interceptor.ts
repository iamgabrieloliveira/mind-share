import { ws } from '../../plugins/echo.ts';
import type { InternalAxiosRequestConfig } from 'axios';

export default function (request: InternalAxiosRequestConfig) {
    request.headers['X-Socket-ID '] = ws.socketId();
    return request;
}
