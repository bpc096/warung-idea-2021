<template>
  <div class="user-list-page">
    <div class="title-tab">
      All User List
    </div>
    <div class="container-fluid">
      <router-link to="userlist/add_user" class="btn btn-primary btn-sm mb-2">Create</router-link>
      <div class="table-responsive">
        <table class="table table-stripped table-bordered">
          <thead>
            <tr>
              <td><b>Name</b></td>
              <td><b>Email</b></td>
              <td><b>Type</b></td>
              <td><b>Action</b></td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(user, index) in list" :key="index">
              <td>{{user.name}}</td>
              <td>{{user.email}}</td>
              <td>{{getType(user.role)}}</td>
              <td>
                <router-link class="btn btn-warning btn-sm" to="/">Edit</router-link>
                <button type="button" class="btn btn-danger btn-sm" v-if="user.role != '1'">Hapus</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios"

export default {
  name: 'UserListPage',
  data() {
    return {
      list: []
    }
  },
  methods: {
    async getUserList() {
      const req = await axios.get('user/get_user')
      const res = req.data
      this.list = res.users.data
    },
    getType(type) {
      switch(type) {
        case '1':
          return 'Super Admin'
          break
        case '2':
          return 'Admin'
          break
        case '3':
          return 'Creator'
          break
        default:
          return '-'
      }
    }
  },
  created() {
    this.getUserList()
  }
}
</script>

<style lang="less" scoped>
.user-list-page {
  width: 100%;
  .title-tab {
    margin: 5rem 0;
    font-size: 30px;
    font-weight: bold;
    text-align: center;
  }
}
</style>
