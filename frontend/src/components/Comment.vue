<template>
  <div class="row">
    <!--Редактор комментария-->
    <div class="col">
      <InputBlock
        v-if="editMode"
        focused
        :content="comment.text"
        @saveBtnClick="onSave"
        @cancelBtnClick="onCancel"
      />
      <div class="row" v-if="!editMode">
        <div class="col d-inline-flex align-items-baseline">
          <div>{{ comment.text }}</div>
          <div
            v-if="comment.author.id == currentUser.id"
            class="dropdown"
            @mouseover="contextMenuShow = true"
            @mouseleave="contextMenuShow = false"
          >
            <button
              class="btn dropdown-toggle"
              type="button"
              id="dropdownMenuButton1"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            />
            <ul
              :class="['dropdown-menu', { show: contextMenuShow }]"
              aria-labelledby="dropdownMenuButton1"
            >
              <li>
                <button
                  @click="editMode = true"
                  type="button"
                  class="dropdown-item"
                >
                  Редактировать
                </button>
              </li>
              <li><hr class="dropdown-divider" /></li>
              <li>
                <button
                  @click="modal.show()"
                  type="button"
                  class="dropdown-item"
                >
                  Удалить
                </button>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!--Информация об авторстве комментария-->
      <div v-if="!editMode" class="text-muted fs-6 d-flex align-items-center">
        <img src="@/assets/avatar.svg" />&nbsp;
        {{ comment.author.firstName }}
        {{ comment.author.lastName }}&nbsp;
        {{
          new Date(comment.createdAt).toLocaleDateString('ru-RU', {
            month: 'long',
            day: 'numeric',
          })
        }}
      </div>

      <!--Модальное окно подтверждения удаления комментария-->
      <div class="modal fade" ref="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              Вы уверены, что хотите удалить комментарий?
            </div>
            <div class="modal-footer">
              <button
                @click="onModalConfirm"
                class="btn btn-danger"
                data-bs-dismiss="modal"
              >
                Да
              </button>
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Нет
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import InputBlock from './InputBlock';
import { Modal } from 'bootstrap';

export default {
  name: 'Comment',
  components: {
    InputBlock,
  },
  props: {
    comment: Object,
    currentUser: Object,
  },
  data() {
    return {
      contextMenuShow: false,
      editMode: false,
      modal: null,
    };
  },
  methods: {
    onSave(text) {
      this.$emit('endEditing', [this.comment.id, text]);
      this.contextMenuShow = false;
      this.editMode = false;
    },
    onCancel() {
      this.editMode = false;
      this.contextMenuShow = false;
    },
    onModalConfirm() {
      this.$emit('removeComment', this.comment.id);
    },
  },
  mounted() {
    this.modal = new Modal(this.$refs.modal);
  },
};
</script>
