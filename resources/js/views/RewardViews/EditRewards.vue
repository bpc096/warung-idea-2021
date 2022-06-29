<template>
  <div class="user-profile-edit-page">
    <div class="title-page">
      EDIT REWARDS
    </div>
    <div class="user-profile-card">
      <form @submit.prevent="submitCampaign">
        <div class="user-profile-content">
          <div class="user-name">
            <div class="text-label">Rewards Title</div>
            <div class="text-value">
              <input
                v-model="title"
                type="text"
                class="form-control"
                placeholder="Title.."
              >
            </div>
          </div>
          <div class="user-name">
            <div class="text-label">Rewards Price</div>
            <div class="text-value">
              <input
                v-model="rewardPrice"
                @keypress="isNumber($event)"
                type="text"
                class="form-control"
                placeholder="Reward Price ..."
              >
            </div>
          </div>
          <div class="user-name">
            <div class="text-label">Rewards Description</div>
            <div class="text-desc-form">
              <textarea
                v-model="description"
                type="text"
                class="form-control"
                placeholder="Description.."
                rows="4"
                cols="50"
              >
              </textarea>
            </div>
          </div>
        </div>
        <div class="button-wrap">
          <button
            type="submit"
            class="button-edit-profile"
            >
            Submit Rewards
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'EditRewards',
  data: () => {
    return {
      title: '',
      description: '',
      rewardPrice: 1,
    }
  },
  async created() {
    const campaignId = this.$route.params.projectId || 1
    const updatesId = this.$route.params.updatesId || 1
  },
  computed: {
    ...mapGetters({
      user: 'user'
    }),
    imageUrl () {
      return this.previewImage ? this.previewImage : this.tempImage
    },
  },
  methods: {
    isNumber (evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
        evt.preventDefault();
      } else {
        return true;
      }
    },
    submitCampaign() {
      let data = new FormData()
      const campaignId = this.$route.params.projectId || 1
      const updatesId = this.$route.params.updateId || 1

      data.append('title', this.title)
      data.append('description', this.description)
      data.append('amount', this.rewardPrice)
      const param = { campaignId, updatesId, data}

      this.$store
        .dispatch('editRewards', param)
        .then(() => {
          this.$router.push({
            name: 'HistoryCampaign'
          })
        })
        .catch(err => {
          console.log(err)
        })
    },
  }

}
</script>

<style lang="less" scoped >
.user-profile-edit-page {
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin: 10rem 0;

  .title-page {
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 2rem;
  }


  .user-profile-card {
    width: 600px;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    border-radius: 20px;
    padding: 10px;

    .user-profile-content {
      margin: 5rem 0;
    }

    .user-image {
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
      .image {
        width: 100px;
        height: 100px;
        background-color: gray;
        border-radius: 50%;
      }
    }

    .user-name,
    .user-avatar {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      margin: 4rem 0;

      .text-label {
        margin-left: 2rem;
      }

      .text-value {
        margin-right: 2rem;
      }

      .text-desc-form {
        margin-right: 2rem;
        max-width: 21rem;
      }

      .text-collaborator {
        margin-right: 2rem;
        max-width: 18rem;
      }

      .text-category {
        margin-right: 2rem;
        min-width: 13.5rem;
      }
    }

      .button-wrap {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        margin-bottom: 3rem;

        button {
          text-decoration: none;
          color: black;

          &:hover {
            cursor: pointer;
            background-color: pink;
          }
        }

        .button-edit-profile {
          background-color: #4FBDBA;
          width: 13rem;
          height: 2.5rem;
          display: flex;
          justify-content: center;
          align-items: center;
          border-radius: 20px;
        }

        .button-change-password {
          background-color: #F05454;
          width: 13rem;
          height: 2.5rem;
          display: flex;
          justify-content: center;
          align-items: center;
          border-radius: 20px;
        }

      }

  }
}
</style>
