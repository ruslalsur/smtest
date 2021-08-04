<template>
  <nav class="navbar navbar-light bg-light mb-2">
    <div class="container-md d-flex justify-content-between">
      <a class="navbar-brand" href="#">Comments CRUD</a>
      <div v-if="currentUser">
        <small>current user:</small>
        <span class="text-success ms-1"
          >{{ currentUser.firstName }}&nbsp;{{ currentUser.lastName }}</span
        >
      </div>
    </div>
  </nav>

  <div v-if="post" class="container-md">
    <div class="row">
      <div class="col">
        <div class="mb-4">
          <h1>{{ post.title }}</h1>
          <p class="fs-5 ">{{ post.text }}</p>
        </div>

        <CommentInputBlock @saveBtnClick="addComment($event)" />

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
</template>
<script>
import 'bootstrap/dist/css/bootstrap.min.css';
import CommentInputBlock from '../CommentInputBlock';
import Comment from '../Comment';
import postsMixin from '../mixins/postsMixin';

export default {
  name: 'Post',
  props: {},
  components: {
    CommentInputBlock,
    Comment,
  },
  mixins: [postsMixin],
  data() {
    return {
      currentUser: null,
      post: null,
      contextMenuShow: false,
    };
  },
  computed: {},
  methods: {},
  async mounted() {
    if (!this.currentUser) {
      this.currentUser = JSON.parse(localStorage.getItem('currentUser'));
      if (!this.currentUser) await this.getCurrentUser();
    }

    if (!this.post) await this.fetchPosts();
  },
};
</script>
