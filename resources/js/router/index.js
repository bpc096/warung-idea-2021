import Vue from 'vue'
import Router from 'vue-router'

// Views
import LandingPage from '../views/LandingPage.vue'
import HomePage from '../views/HomePage.vue'
import AboutUsPage from '../views/AboutUsPage.vue'
import DiscoveryPage from '../views/DiscoveryPage.vue'
import CategoryPage from '../views/CategoryPage.vue'
import ProjectDetailPage from '../views/ProjectDetailPage.vue'
import LoginPage from '../views/LoginPage.vue'
import RegisterPage from '../views/RegisterPage.vue'
import CheckoutPage from '../views/CheckoutPage.vue'

// Views Campaign
import CreateCampaign from '../views/campaignViews/CreateCampaign.vue'
import EditCampaign from '../views/campaignViews/EditCampaign.vue'
import HistoryCampaign from '../views/campaignViews/HistoryCampaign.vue'
import HistoryDonationCampaign from '../views/campaignViews/HistoryDonationCampaign.vue'
import CampaignCollaboration from '../views/campaignViews/CampaignCollaboration.vue'


// Views Updates
import CreateUpdates from '../views/updatesViews/CreateUpdates.vue'
import EditUpdates from '../views/updatesViews/EditUpdates.vue'

// Views Faqs
import CreateFaqs from '../views/faqViews/CreateFaqs.vue'
import EditFaqs from '../views/faqViews/EditFaqs.vue'

// Views Rewards
import CreateRewards from '../views/rewardViews/CreateRewards.vue'
import EditRewards from '../views/RewardViews/EditRewards.vue'

// Views User
import UserProfile from '../views/userViews/UserProfile.vue'
import ChangePassword from '../views/userViews/ChangePassword.vue'
import EditProfile from '../views/userViews/EditProfile.vue'
import InvitationPage from '../views/userViews/InvitationPage.vue'

// Views Tab
import CampaignTab from '../views/tabViews/CampaignTab.vue'
import UpdateTab from '../views/tabViews/UpdateTab.vue'

// Private Message
import ChatPage from '../views/chatViews/ChatPage.vue'
import ChatPageAdvance from '../views/chatViews/ChatPageAdvance.vue'
import ChatContainer from '../views/chatViews/ChatContainer.vue'

// Dashboard Page
import DashboardPage from '../views/dashboardViews/DashboardPage.vue'
import UserListPage from '../views/dashboardViews/UserListPage.vue'
import CampaignListPage from '../views/dashboardViews/CampaignListPage.vue'
import CreateNewAdmin from '../views/dashboardViews/CreateAdminPage.vue'
import RequestListPage from '../views/dashboardViews/RequestListPage.vue'
import RequestCreatePage from '../views/dashboardViews/RequestCreatePage.vue'
import RequestDeletePage from '../views/dashboardViews/RequestDeletePage.vue'
import RequestFinishedPage from '../views/dashboardViews/RequestFinishedPage.vue'
import AddUserPage from "../views/dashboardViews/AddUser.vue"
import EditUserPage from "../views/dashboardViews/EditUser.vue"

// store
import store from '../store'

Vue.use(Router)

const routes = [
  {
    path: '/',
    name: 'LandingPage',
    component: LandingPage,
  },
  {
    path: '/register',
    name: 'RegisterPage',
    component: RegisterPage,
  },
  {
    path: '/login',
    name: 'LoginPage',
    component: LoginPage,
  },
  {
    path: '/home',
    name: 'HomePage',
    component: HomePage,
  },
  {
    path: '/aboutus',
    name: 'AboutUsPage',
    component: AboutUsPage,
  },
  {
    path: '/discover',
    name: 'DiscoveryPage',
    component: DiscoveryPage,
  },
  {
    path: '/category/:categoryId',
    name: 'CategoryPage',
    component: CategoryPage,
    children: [
      {
        path: 'campaigntab',
        component: CampaignTab,
      },
      {
        path: 'updatestab',
        component: UpdateTab,
      }
    ]
  },
  {
    path: '/projectdetail/:projectId',
    name: 'ProjectDetail',
    component: ProjectDetailPage,
    meta: {
      auth: true,
    }
  },
  {
    path: '/checkout',
    name: 'CheckoutPage',
    component: CheckoutPage,
    meta: {
      auth: true,
    }
  },
  {
    path: '/profile',
    name: 'UserProfile',
    component: UserProfile,
    meta: {
      auth: true,
    }
  },
  {
    path: '/profile/changepassword',
    name: 'ChangePassword',
    component: ChangePassword,
    meta: {
      auth: true,
    }
  },
  {
    path: '/profile/editProfile',
    name: 'EditProfile',
    component: EditProfile,
    meta: {
      auth: true,
    }
  },
  {
    path: '/profile/invitation',
    name: 'InvitationPage',
    component: InvitationPage,
    meta: {
      auth: true,
    }
  },
  {
    path: '/campaign/create',
    name: 'CreateCampaign',
    component: CreateCampaign,
  },
  {
    path: '/campaign/history',
    name: 'HistoryCampaign',
    component: HistoryCampaign,
  },
  {
    path: '/campaign/collaboration',
    name: 'CampaignCollaboration',
    component: CampaignCollaboration,
  },
  {
    path: '/campaign/history/donation',
    name: 'HistoryDonationCampaign',
    component: HistoryDonationCampaign,
  },
  {
    path: '/campaign/edit/:projectId',
    name: 'EditCampaign',
    component: EditCampaign,
  },
  {
    path: '/updates/create/:projectId',
    name: 'CreateUpdates',
    component: CreateUpdates,
  },
  {
    path: '/updates/edit/:projectId/:updateId',
    name: 'EditUpdates',
    component: EditUpdates,
  },
  {
    path: '/faqs/create/:projectId',
    name: 'CreateFaqs',
    component: CreateFaqs,
  },
  {
    path: '/faqs/edit/:projectId/:updateId',
    name: 'EditFaqs',
    component: EditFaqs,
  },
  {
    path: '/rewards/create/:projectId',
    name: 'CreateRewards',
    component: CreateRewards,
  },
  {
    path: '/rewards/edit/:projctId/:updateId',
    name: 'EditRewards',
    component: EditRewards,
  },
  {
    path: '/chat',
    name: 'ChatPage',
    component: ChatPage,
    children: [
      {
        path: 'user/:userId',
        name: 'ChatContainer',
        component: ChatContainer,
      }
    ]
  },
  {
    path: '/chat/advance',
    name: 'ChatPageAdvance',
    component: ChatPageAdvance,
  },
  {
    path: '/admin/dashboard',
    name: 'DashboardPage',
    component: DashboardPage,
    meta: {
      // Change this to false when finsihed
      authAdmin: false,
    },
    children: [
      {
        path: 'userlist',
        component: UserListPage,
      },
      {
        path: 'add_user',
        component: AddUserPage
      },
      {
        path: 'edit_user/:id',
        component: EditUserPage
      },
      {
        path: 'campaignlist',
        component: CampaignListPage,
      },
      {
        path: 'createadmin',
        component: CreateNewAdmin,
      },
      {
        path: 'requestlist/becomecreator',
        component: RequestListPage,
      },
      {
        path: 'requestlist/createcampaign',
        component: RequestCreatePage
      },
      {
        path: 'requestlist/deletecampaign',
        component: RequestDeletePage
      },
      {
        path: 'requestlist/finishedcampaign',
        component: RequestFinishedPage
      }
    ]
  }
]

const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  if(to.matched.some(record => record.meta.authAdmin)){
    const isLoggedIn = store.getters.isLoggedIn
    const user = store.getters.user

    /*
    User Role Explanation
    1 = Superadmin
    2 = Admin
    3 = Creator
    **/

    if(isLoggedIn && user && (user.role === '1' || user.role === '2')) {
      next()
      return
    }
    Vue.toasted.error("Silahkan login sebagai admin terlebih dahulu!", {position: 'top-center', duration: 3000})
    next('/login')
  }


  if(to.matched.some(record => record.meta.auth)) {
    if(store.getters.isLoggedIn && store.getters.user) {
      next()
      return
    }
    Vue.toasted.error("Silahkan login terlebih dahulu!", {position: 'top-center', duration: 3000})
    next('/login')
  }

  if(to.matched.some(record => record.meta.guest)) {
    if(!store.getters.isLoggedIn) {
      next()
      return
    }
    next('/profile')
  }

  next()
})

export default router
