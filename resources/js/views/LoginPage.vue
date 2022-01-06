<template>
<div class="row justify-content-md-center wrap-login-page">
    <div class="col-md-6 login-card">
      <div class="card">
        <div class="card-header">Login WarungIdea</div>
        <div class="card-body">
          <form>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" placeholder="Username..">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" placeholder="Password..">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'LoginPage',

}
</script>

<style lang="less" scoped>
.wrap-login-page {
  height: 90vh;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;

  .login-card {
    max-width: 30%;
  }
}
</style>
