<template>
  <div>
    <multiselect
      v-model="value"
      :options="options"
      :multiple="true"
      :taggable="true"
      @tag="addTag"
      tag-placeholder="Add this as new tag"
      placeholder="Type to search or add tag"
      label="name"
      track-by="code"
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
    props: {
      value: {
        type: Array,
        default: [
          { name: 'Janto pasto', code: 'js' }
        ]
      },
      options: {
        type: Array,
        default: [
          { name: 'Vuang agung', code: 'vu' },
          { name: 'Joni Yes', code: 'js' },
          { name: 'Onad sodin', code: 'os' }
        ]
      }
    },
    methods: {
      addTag (newTag) {
        const tag = {
          name: newTag,
          code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
        }
        this.options.push(tag)
        this.value.push(tag)
      }
    }
  }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
