<template>  
  <div>
      <h1>THIS IS LANDING PAGE</h1>
      <h2>Checking state : {{ this.number }}</h2>
      <button @click="addNumber">
        add numb
      </button>
      <button @click="subtractNumber">
        subtract numb
      </button>
  </div>
</template>

<script>
import store from '../store'
import { mapState } from 'vuex' 
 
export default {
  name: 'CheckingState',
  computed: {
    ...mapState({
      number: state => store.state.number
    })
  },
  methods: {
    addNumber () {
      store.dispatch('addingNumber')
    },
    subtractNumber () {
      store.dispatch('subtractNumber')
    }
  }
}
</script>

<style>

</style>