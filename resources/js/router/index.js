import Vue from 'vue'
import Router from 'vue-router'

// Components
import HelloWorld from '../components/HelloWorld.vue'
import HaloGuys from '../components/HaloGuys.vue'

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

// Views User
import UserProfile from '../views/userViews/UserProfile.vue'
import ChangePassword from '../views/userViews/ChangePassword.vue'
import EditProfile from '../views/userViews/EditProfile.vue'

// Views Tab
import CampaignTab from '../views/tabViews/CampaignTab.vue'
import UpdateTab from '../views/tabViews/UpdateTab.vue'

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
    component: ProjectDetailPage
  },
  {
    path: '/checkout',
    name: 'CheckoutPage',
    component: CheckoutPage,
  },
  {
    path: '/profile',
    name: 'UserProfile',
    component: UserProfile,
    meta: {
      // TODO: change auth to true after development
      auth: false,
    }
  },
  {
    path: '/profile/changepassword',
    name: 'ChangePassword',
    component: ChangePassword,
    meta: {
      // TODO: Change auth to true after ddevelopment
      auth: false
    }
  },
  {
    path: '/profile/editProfile',
    name: 'EditProfile',
    component: EditProfile,
    meta: {
      // TODO: Change auth to true
      auth: false
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
    path: '/haloguys',
    name: 'HaloGuys',
    component: HaloGuys,
  },
  {
    path: '/helloworld',
    name: 'HelloWorld',
    component: HelloWorld,
  }
]

const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  if(to.matched.some(record => record.meta.auth)) {
    if(store.getters.isLoggedIn && store.getters.user) {
      next()
      return
    }
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
