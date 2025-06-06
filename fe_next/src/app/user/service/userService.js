import { fetchData } from '@/lib/fetcher';

export const UserService = {
  async getAllUsers() {
 const response = await fetchData({
        url: 'api/user/findall',
        method: 'POST',
        body:''
    });

    return response?.data?.user||[]
  },

//   async getUser(id) {
//     return await fetchData({
//       url: 'api/user/'+id,
//       method:'POST'
//     });
//   },
};
