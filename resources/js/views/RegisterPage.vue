<template>
  <div class="row justify-content-md-center wrap-register-page">
    <div class="col-md-6 register-card">
      <div class="card">
        <div class="card-header">
          Register WarungIdea
        </div>
        <div class="card-body">
          <form>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" placeholder="Name..">
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" placeholder="Email..">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" placeholder="Password..">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'RegisterPage'
}
</script>

<style lang="less" scoped>
.wrap-register-page {
  height: 90vh;
  display: flex;
  justify-content: center;
  align-items: center;
  .register-card {
    max-width: 30%;
  }
}
</style>
