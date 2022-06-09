<template>
  <div class="container mt-3">
    <h2>Edit User</h2>
    <router-link to="/admin/dashboard/userlist" class="btn btn-primary btn-sm mb-2">Back</router-link>
    <div class="card">
      <form @submit.prevent="submitForm">
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" required placeholder="Example: John" v-model="name" class="form-control"/>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" required placeholder="Example: john@gmail.com" v-model="email" class="form-control"/>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-label">Role <span class="text-danger">*</span></label>
                <select class="form-control" required v-model="role">
                  <option value="">-- Choose Role --</option>
                  <option value="1" v-if="role == '1'">Super Admin</option>
                  <option value="2" v-if="role != '1'">Admin</option>
                  <option value="3" v-if="role != '1'">Creator</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" placeholder="Fill this field if you want to update password" v-model="password" class="form-control"/>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label">Avatar</label>
                <input type="file" @change="getAvatar" class="form-control"/>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-success btn-sm mb-2" style="float: left">Save</button>
        </div>
      </form>
    </div>
  </div>
  
</template>
<script>
import axios from "axios"
import Swal from "sweetalert2"
export default {
  data() {
    return {
      id: '',
      name: '',
      email: '',
      password: '',
      role: '',
      avatar: null
    }
  },
  methods: {
    async submitForm() {
      const confirm = await Swal.fire({
        title: 'Confirmation',
        text: 'Edit Data?',
        icon: 'question',
        showCancelButton:  true
      })
      if(confirm.isConfirmed) {
        try {
          const data = new FormData()
          data.append('id', this.id)
          data.append('name', this.name)
          data.append('email', this.email)
          data.append('password', this.password)
          data.append('role', this.role)
          data.append('avatar', this.avatar)

          const req = await axios.post('user/update_user', data)
          const res = req.data
          
          if(res.success) {
            const message = await Swal.fire('Success', res.message, 'success')
            if(message.isConfirmed) {
              this.$router.push('/admin/dashboard/userlist')
            }
          }
        } catch(e) {
          console.error(e)
        }
      }
    },
    getAvatar(e) {
      this.avatar = e.target.files[0]
      console.log(this.avatar)
    },
    async getDataToEdit() {
      try {
        const req = await axios.get(`user/edit/${this.$route.params.id}`)
        const res = req.data
        this.name = res.user.name
        this.id = res.user.id
        this.email = res.user.email
        this.role = res.user.role
      } catch(e) {
        console.error(e)
      }
    }
  },
  created() {
    this.getDataToEdit()
  }
}
</script>
<style scoped>
  .form-label {
    float: left;  
  }
</style>