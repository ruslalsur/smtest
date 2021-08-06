<template>
  <div>
    <Header :currentUser="currentUser" />

    <div v-if="post" class="container-md">
      <div class="row">
        <div class="col">
          <!--Пост-->
          <div class="mb-4">
            <h1>{{ post.title }}</h1>
            <p class="fs-5 ">{{ post.text }}</p>
          </div>

          <!--Блок для создания комментария-->
          <InputBlock @saveBtnClick="addComment($event)" />

          <!--Коментарии поста-->
          <div class="ms-4">
            <div
              class="my-4 lh-sm fs-5"
              v-for="comment in post.comments"
              :key="comment.id"
            >
              <Comment
                @endEditing="updateComment($event[0], $event[1])"
                @removeComment="removeComment"
                :comment="comment"
                :currentUser="currentUser"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Header from '../Header';
import Comment from '../Comment';
import InputBlock from '../InputBlock';
import postsMixin from '../mixins/postsMixin';

export default {
  name: 'Post',
  components: {
    Header,
    Comment,
    InputBlock,
  },
  mixins: [postsMixin],
  data() {
    return {
      currentUser: null,
      post: null,
      contextMenuShow: false,
    };
  },
  async mounted() {
    if (!this.currentUser) await this.getCurrentUser();
    if (!this.post) await this.fetchPosts();
  },
};
</script>
