<template>
  <div>
    <input
      required
      @focus="showButtons = true"
      v-model="text"
      type="text"
      class="form-control"
      id="commentInput"
      placeholder="Написать комментарий"
    />
    <div v-if="isEmpty" class="ms-2 text-danger small">
      Поле не может быть пустым
    </div>
    <div class="d-flex mt-3" v-if="showButtons">
      <button @click="onSave" type="button" class="btn btn-primary me-2">
        Сохранить
      </button>
      <button @click="onCancel" type="button" class="btn btn-outline-dark">
        Отмена
      </button>
    </div>
  </div>
</template>

<script>
import 'bootstrap/dist/css/bootstrap.min.css';
export default {
  name: 'CommentInputBlock',
  props: {
    focused: {
      type: Boolean,
      default: false,
    },
    content: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      showButtons: this.focused,
      text: this.content,
      isEmpty: false,
    };
  },
  methods: {
    onSave() {
      if (this.text.trim()) {
        this.$emit('saveBtnClick', this.text);
        this.text = '';
        this.showButtons = false;
        this.isEmpty = false;
      } else {
        this.isEmpty = true;
      }
    },
    onCancel() {
      this.showButtons = false;
      this.$emit('cancelBtnClick');
      this.isEmpty = false;
    },
  },
};
</script>
