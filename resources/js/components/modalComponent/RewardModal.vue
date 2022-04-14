<template>
  <div class="modal-mask">
    <div class="modal-wrapper">
      <div class="modal-container">
        <div class="modal-scroll">
          <div class="modal-non-reward">
            <div class="text-label">Donasi Sukarela</div>
            <form @submit.prevent="donateAmount">
              <input
                v-model="amountDonation"
                id="amount"
                class="input-amount"
                type="text"
                name="amount"
              >
              <a class="btn-donate" type="submit">
                Donate!
              </a>
            </form>
          </div>
          <div v-if="checkRegexAlphabet || checkAmountInvalid" class="text-error">Please Input Valid Number!</div>

          <div v-for="(d, idx) in data" :key="idx">
            <router-link :to="{path: '/checkout', query: {campaignId: campaignId, totalAmount: d.rewardAmount }}">
              <div class="reward-card-container">
                <div class="reward-price">
                  <div class="reward-image">
                  </div>
                  <div class="reward-text-price">
                    {{ d.rewardPrice }}
                  </div>
                </div>
                <div class="reward-title">
                  {{ d.rewardTitle }}
                </div>
                <div class="reward-desc">
                  {{ d.rewardDesc }}
                </div>
              </div>
            </router-link>
            <div
              v-if="checkUserOwner"
              class="button-wrap"
            >
              <a :href="`/rewards/edit/${campaignId}/${d.rewardId}`" class="btn btn-edit">
                Edit
              </a>
              <a @click="deleteReward" class="btn btn-delete">
                Delete
              </a>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <slot name="footer">
            <button
              class="modal-default-button"
              @click="closeModal">
              X
            </button>
          </slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'RewardModal',
  props: {
    campaignId: {
      type: Number,
      default: 1,
    },
    userId: {
      type: Number,
      default: 1
    },
    ownerId: {
      type: String,
      default: "0"
    }
  },
  data: () => {
    return {
      listData: [
        {
          rewardId: '1',
          rewardPrice: 'Rp20.000',
          rewardAmount: '20000',
          rewardTitle: 'Reward 01',
          rewardDesc: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Id illum sunt, temporibus unde aut veniam repellendus. Quo voluptatum ad praesentium.'
        },
        {
          rewardId: '2',
          rewardPrice: 'Rp150.000',
          rewardAmount: '150000',
          rewardTitle: 'Reward 02',
          rewardDesc: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Id illum sunt, temporibus unde aut veniam repellendus. Quo voluptatum ad praesentium.'
        },
        {
          rewardId: '3',
          rewardPrice: 'Rp500.000',
          rewardAmount: '500000',
          rewardTitle: 'Reward 03',
          rewardDesc: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Id illum sunt, temporibus unde aut veniam repellendus. Quo voluptatum ad praesentium.'
        },
        {
          rewardId: '4',
          rewardPrice: 'Rp1.000.000',
          rewardAmount: '1000000',
          rewardTitle: 'Reward 04',
          rewardDesc: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Id illum sunt, temporibus unde aut veniam repellendus. Quo voluptatum ad praesentium.'
        },
        {
          rewardId: '5',
          rewardPrice: 'Rp10.000.000',
          rewardAmount: '10000000',
          rewardTitle: 'Reward 05',
          rewardDesc: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Id illum sunt, temporibus unde aut veniam repellendus. Quo voluptatum ad praesentium.'
        }
      ],
      amountDonation: '0',
      realListData: [],
    }
  },
  updated() {
    const campaignId = this.campaignId
    this.$store
      .dispatch('getRewardsByCampaignId', campaignId)
      .then(res => {
        if(res.success && res.data && res.data.length > 0) {
          this.listData = res.data
        }
      })
      .catch(err => {
        console.error(err)
      })
  },
  computed: {
    amountDonationToNumber () {
      return  parseInt(this.amountDonation)
    },
    checkRegexAlphabet () {
      const pattern = /^[0-9]*$/g
      return !pattern.test(this.amountDonation)
    },
    checkAmountInvalid () {
      return this.amountDonationToNumber > 10000000000000 || this.amountDonationToNumber < 0
    },
    checkUserOwner() {
      return true
      // return parseInt(this.ownerId) === this.userId
    }
  },
  methods: {
    closeModal () {
      this.$emit('close')
    },
    donateAmount () {
      if( this.checkRegexAlphabet || this.checkAmountInvalid || this.amountDonationToNumber === 0) return

      const totalAmount = this.amountDonationToNumber
      this.$router.push({
        name: 'CheckoutPage',
        params: {
          totalAmount: totalAmount,
          campaignId: this.campaignId
        }
      })
    },
    deleteReward() {
      // TODO: TB Developed once can create
      console.log('delete reward')
    }
  }
}
</script>

<style lang="less" scoped>
.modal-mask {
  position: fixed;
  z-index: 2;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
  display: flex;
  justify-content: center;
  align-items: center;

  .modal-wrapper {
    display: flex;
    flex-direction: column;

    .modal-container {
      margin: 0px auto;
      padding: 20px 30px;
      background-color: #fff;
      border-radius: 20px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
      transition: all 0.3s ease;
      font-family: Helvetica, Arial, sans-serif;

      .modal-scroll {
        width: 700px;
        height: 700px;
        overflow: auto;
      }

      div > a {
        text-decoration: none;
        color: black;
      }

      .text-error {
        color: red;
      }

      .modal-non-reward {
        display: flex;
        flex-direction: row;
        padding: 10px;
        border-radius: 10px;
        margin: 30px 0;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        justify-content: center;
        align-items: center;

        .text-label {
          margin: 0 10px;
        }

        .input-amount {
          margin: 0 10px;
          width: 300px;
        }

        a {
          border: 1px solid black;
          border-radius: 10px;
          margin-left: .5rem;
          text-decoration: none;
          color: black;
          min-width: 5rem;

          &:hover {
            color: white;
            background-color: green;
          }
        }
      }

      .button-wrap {
          margin: 1rem 0;
          text-align: center;

          .btn {
            border: 1px solid black;
            border-radius: 10px;
            margin-left: .5rem;
            &-delete:hover {
              background-color: red;
              color: white
            }
            &-edit:hover {
              background-color: green;
              color: white;
            }
          }
        }

      .reward-card-container {
        text-align: left;
        display: flex;
        flex-direction: column;
        padding: 10px;
        border-radius: 10px;
        margin: 30px 0;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;

        &:hover {
          box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }

        .reward-price {
          display: flex;
          flex-direction: row;
          align-items: center;

          .reward-image {
            background-color: black;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 20px;
          }

          .reward-text-price {
            font-size: 25px;
            font-weight: bold;
          }
        }

        .reward-title {
          font-size: 20px;
          font-weight: bold;
        }

        .reward-desc {
          font-size: 15px;
        }
      }
    }
  }

}


</style>
