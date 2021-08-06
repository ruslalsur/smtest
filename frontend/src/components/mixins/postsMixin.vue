<script>
import axios from 'axios';
axios.defaults.baseURL = 'http://localhost:8000';
export default {
  methods: {
    async getCurrentUser() {
      try {
        const response = await axios({
          url: '/user',
        });

        if (!response) throw new Error('ошибка');

        this.currentUser = response.data;
        localStorage.setItem('currentUser', JSON.stringify(response.data));
      } catch (error) {
        console.log(error);
      }
    },

    async fetchPosts() {
      try {
        const response = await axios({ url: '/' });
        if (!response) throw new Error('ошибка');
        this.post = response.data[0];
      } catch (error) {
        console.log(error);
      }
    },

    async addComment(text) {
      try {
        const response = await axios({
          url: '/comments/add',
          method: 'POST',
          data: {
            text,
            userId: this.currentUser.id,
            postId: this.post.id,
          },
        });

        if (response.status == 201) {
          this.fetchPosts();
        }
      } catch (error) {
        console.log(error);
      }
    },

    async updateComment(id, text) {
      try {
        const response = await axios({
          url: `/comments/update/${id}`,
          method: 'PATCH',
          data: {
            text,
            userId: this.currentUser.id,
            commentId: this.post.id,
          },
        });

        if (response.status == 200) {
          this.fetchPosts();
        }
      } catch (error) {
        console.log(error);
      }
    },

    async removeComment(id) {
      try {
        const response = await axios({
          url: `/comments/remove/${id}`,
          method: 'DELETE',
        });

        if (response.status == 200) {
          this.fetchPosts();
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>
