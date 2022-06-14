<template>
  <div class="wrap-dashboard-page">
    <sidebar-menu
      class="sidebar-menu-custom"
      :menu="menu"
      theme="white-theme"
      :hideToggle="true"
      @item-click="onItemClick"
    />
    <div class="dashboard-main-menu">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import { SidebarMenu } from 'vue-sidebar-menu'
const baseUrl = '/admin/dashboard/'

export default {
  name: 'DashboardPage',
  components: {
    SidebarMenu
  },
  data() {
    return {
      menu: [{
              header: true,
              title: 'Admin Dashboard',
              hiddenOnCollapse: false,
            },{
              icon: 'fa fa-user',
              title: 'User Management',
              child: [
                {
                  href: {path: baseUrl + 'userlist'},
                  title: 'List of User',
                },
                {
                  href: {path:  baseUrl + 'requestlist/becomecreator'},
                  title: 'Request Become Creator',
                },
              ]
            }, {
              icon: 'fa-solid fa-lightbulb',
              title: 'Campaign Management',
              child: [
                {
                  href: {path:  baseUrl + 'campaignlist'},
                  title: 'List of Campaign',
                },
                {
                  href: {path:  baseUrl + 'requestlist/createcampaign'},
                  title: 'Create Campaign Request',
                },
                {
                  href: {path:  baseUrl + 'requestlist/deletecampaign'},
                  title: 'Delete Campaign Request',
                },
                {
                  href: {path:  baseUrl + 'requestlist/finishedcampaign'},
                  title: 'Finished Campaign Request',
                },
              ]
            }, {
              icon: 'fa-solid fa-gear',
              title: 'Admin Setting',
              child: [
                {
                  title: 'Home'
                },
                {
                  title: 'Logout'
                }
              ]
            }
          ]
    }
  },
  methods: {
    onItemClick(event, item, node) {
      switch(item.title){
        case 'Logout':
          this.logout()
          break;
        case 'Home':
          this.goToHome()
          break;
      }
    },
    goToHome () {
      this.$router.push('/home')
    },
    logout () {
      this.$swal({
        title: 'Are you sure?',
        text: "You are going to logout",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {
          this.$store
            .dispatch('logout')
            .then(() => {
              this.$swal({
                title: 'Logout Success',
                icon: 'success',
                timer: 3000,
                timerProgressBar: true,
              })
              this.$router.push('/')
            })
        }
      })
    },
  }
}
</script>

<style lang="less" scoped>
.wrap-dashboard-page{
  min-height: 100vh;
  display: flex;
  flex-direction: row;

  .sidebar-menu-custom{
    position: relative;
    min-height: 90vh;
  }

  .dashboard-main-menu {
    width: 100%;
  }

}
</style>
