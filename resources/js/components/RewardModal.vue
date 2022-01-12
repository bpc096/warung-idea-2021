<template>
  <div class="modal-mask">
    <div class="modal-wrapper">
      <div class="modal-container">
        <div v-for="(d, idx) in data" :key="idx">
          <router-link :to="{path: '/checkout', query: { checkoutId: d.rewardId }}">
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
        </div>
        <div class="modal-footer">
          <slot name="footer">
            <button class="modal-default-button" @click="closeModal">
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
  data: () => {
    return {
      data: [
        {
          rewardId: 'rewardId01',
          rewardPrice: 'Rp20.000',
          rewardTitle: 'Reward 01',
          rewardDesc: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Id illum sunt, temporibus unde aut veniam repellendus. Quo voluptatum ad praesentium.'
        },
        {
          rewardId: 'rewardId02',
          rewardPrice: 'Rp500.000',
          rewardTitle: 'Reward 02',
          rewardDesc: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Id illum sunt, temporibus unde aut veniam repellendus. Quo voluptatum ad praesentium.'
        },
        {
          rewardId: 'rewardId03',
          rewardPrice: 'Rp1.000.000',
          rewardTitle: 'Reward 03',
          rewardDesc: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Id illum sunt, temporibus unde aut veniam repellendus. Quo voluptatum ad praesentium.'
        }
      ]
    }
  },
  methods: {
    closeModal () {
      this.$emit('close')
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
      width: 700px;
      margin: 0px auto;
      padding: 20px 30px;
      background-color: #fff;
      border-radius: 20px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
      transition: all 0.3s ease;
      font-family: Helvetica, Arial, sans-serif;

     div > a {
       text-decoration: none;
       color: black;
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
