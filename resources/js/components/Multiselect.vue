<template>
  <div>
    <multiselect
      v-model="value"
      :options="options"
      :multiple="true"
      :taggable="true"
      tag-placeholder="Add this as new tag"
      placeholder="Optional - Add Collaborator"
      label="name"
      track-by="userId"
      @tag="addTag"
      @select="addNewUser"
      @remove="removeNewUser"
    >
    </multiselect>
  </div>
</template>

<script>
  import Multiselect from 'vue-multiselect'
  export default {
    name: 'MutliSelectComponent',
    components: {
      Multiselect
    },
    data: () => {
      return {
        value:  [],
        options:  [
          { name: 'Vuang agung', userId: 1 },
          { name: 'Joni Yes', userId: 2 },
          { name: 'Onad sodin', userId: 3 },
        ],
      }
    },
    created() {
      // Fetching API Collaborator Available
      console.log('created')
    },
    methods: {
      addTag (newTag) {
        console.log('addTag')
        const tag = {
          name: newTag,
          userId: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
        }
        this.$emit('addNewUser', tag)
        this.options.push(tag)
        this.value.push(tag)
      },
      addNewUser (user) {
        const { userId } = user
        this.$emit('addNewUser', userId)
      },
      removeNewUser (user) {
        const { userId } = user
        this.$emit('removeNewUser', userId)
      }
    }
  }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
