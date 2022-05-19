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
  import { mapGetters } from 'vuex'

  export default {
    name: 'MutliSelectComponent',
    props: {
      defaultValue: Array
    },
    components: {
      Multiselect
    },
    data: () => {
      return {
        rawUserList: [],
        value: [] ,
        options:  [
          { name: 'Vuang agung', userId: 1 },
          { name: 'Joni Yes', userId: 2 },
          { name: 'Onad sodin', userId: 3 },
        ],
      }
    },
    async created() {
      console.log('Created Componetn MultiSelect')
      await this.$store
        .dispatch('getCollaboratorAvailableList')
        .then(res => {
          if (res.data.length > 0) {
            this.rawUserList = res.data
            this.mappingUserList()

          }
        })
        .catch(err => {
          console.error(err)
        })
    },
    computed: {
      ...mapGetters({
        user: 'user'
      }),
    },
    methods: {
      mappingUserList() {
        this.options = this.rawUserList.filter(x=>x.user.id!==this.user.id).map(x=>({name:x.user.name, userId:x.user.id}))
      },
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
    },
    watch: {
      'defaultValue'(newValue) {
        this.value = newValue
      }
    }
  }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
