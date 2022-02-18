<template>
  <div>
    <multiselect
      v-model="value"
      :options="options"
      :multiple="true"
      :taggable="true"
      @tag="addTag"
      tag-placeholder="Add this as new tag"
      placeholder="Optional - Add Collaborator"
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
    data: () => {
      return {
        value:  [],
        options:  [
          { name: 'Vuang agung', code: 'vu' },
          { name: 'Joni Yes', code: 'js' },
          { name: 'Onad sodin', code: 'os' },
          { name: 'Janto pasto', code: 'jp' },
          { name: 'Janto pasto', code: 'j23p' },
          { name: 'Janto pasto', code: 'jgp' },
          { name: 'Janto pasto', code: 'fjp' },
          { name: 'Janto pasto', code: 'djp' },
          { name: 'Janto pasto', code: 'jfqp' },
          { name: 'Janto pasto', code: 'jcvp' },
          { name: 'Janto pasto', code: 'jtsp' },
          { name: 'Janto pasto', code: 'jqwep' },
        ],
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
