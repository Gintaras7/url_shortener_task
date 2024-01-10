import axios from '@/plugins/axios';

export const generateShortLink = (url) => {
    return axios.post('links', { url });
};
