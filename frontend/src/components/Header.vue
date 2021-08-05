<template>
  <nav class="navbar navbar-light bg-light mb-2 border-bottom">
    <div class="container-md d-flex justify-content-between">
      <a class="navbar-brand text-secomdary" href="#">Comments CRUD</a>
      <div v-if="currentUser">
        <small>current user:</small>
        <span class="text-success ms-1"
          >{{ currentUser.firstName }}&nbsp;{{ currentUser.lastName }}</span
        >
      </div>
    </div>
  </nav>
</template>
<script>
import 'bootstrap/dist/css/bootstrap.min.css';

export default {
  name: 'Header',
  props: {
    currentUser: Object,
  },
  data() {
    return {};
  },
};
</script>
