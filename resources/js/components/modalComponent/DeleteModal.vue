<template id="modal-template">
  <div class="modal" v-show="showModal" transition="modal">
    <div class="modal-wrapper">
      <div class="modal-container">
        <content select=".modal-header">
          <div class="modal-header">
            <h3>
              Are You Sure Want To REMOVE ?
            </h3>
          </div>
        </content>
        <div class="modal-body">
          Requets approval confirmation for deleting content
        </div>
        <div class="modal-footer uk-clearfix">
            <button @click="closeModal(true)"  class="btn-yes uk-button uk-button-success uk-float-right">
              Sure, Continue !
            </button>
            <button @click="closeModal(false)"  class="btn-no uk-button uk-button-success uk-float-right">
              No, Sorry !
            </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DeleteModal',
  props: {
    showModal: {
      type: Boolean,
      required: true,
      twoWay: true
    }
  },
  methods:{
    closeModal(isContinue) {
      this.$emit('closeModal', isContinue)
    }
  }
}
</script>

<style lang="less" scoped>
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.7);
  display: table;
  transition: opacity 0.3s ease;

  &-wrapper {
    display: table-cell;
    vertical-align: middle;
  }

  &-container {
    background: #fff;
    width: 450px;
    border-radius: 5px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
    margin: 0 auto;
    padding: 20px 30px;
  }

  &-footer {
    margin-top: 15px;
  }

  &-enter,
  &-leave {
    opacity: 0;
  }

  &-enter &-container,
  &-leave &-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
  }

  .btn-yes {
    background-color: green;
    border-radius: 10px;
    border: 1px solid black;
    margin: 10px;
  }

  .btn-no {
    background-color: red;
    border-radius: 10px;
    border: 1px solid black;
    margin: 10px;
    color: white;
  }
}
</style>
