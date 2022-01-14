<template>
  <div class="checkout-page-wrap">
    <div class="content-right">
      <div class="checkout-title">
        YOU'RE CONTRIBUTING TO
        <div class="project-title">
          Project Title
        </div>
      </div>
      <div class="checkout-perks">
        Review Your Contribution
        <div class="perks-title">
          PERKS
        </div>
      </div>
      <div class="checkout-info">
        <div class="checkout-image">
          <img
            :src="dummyImage"
            class="image-coffee-dummy"
            alt="image-coffee-dummy"
          >
        </div>
        <div class="checkout-reward">
          <div class="reward-title">
            Reward Name
          </div>
          <div class="reward-price">
            Rp123.000
          </div>
        </div>
      </div>
    </div>
    <div class="content-left">
      <div class="content-contribution">
        <div class="title-summary">Contribution Summary</div>
        <div class="subtotal-text">
          <div class="subtotal-title">
            Subtotal
          </div>
          <div class="subtotal-price">
            Rp123000,-
          </div>
        </div>
        <div class="shipping-text">
          <div class="shipping-title">
            Shipping
          </div>
          <div class="shipping-price">
            Rp0,-
          </div>
        </div>
        <div class="total-text">
          <div class="total-title">
            TOTAL
          </div>
          <div class="total-price">
            Rp123000,-
          </div>
        </div>
      </div>
      <div class="btn-checkout">
        <button>
          PROCEED TO CHECKOUT
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CheckoutPage',
  computed: {
    dummyImage() {
      return 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80'
    }
  }
}
</script>

<style lang="less" scoped>
.checkout-page-wrap {
  height: 90vh;
  display: flex;
  flex-direction: row;

  .content-right {
    border-right: 1px solid black;
    width: 50%;
    padding: 5rem;

    .checkout-title {
      text-align: left;
      margin: 2rem 0;
      .project-title {
        font-size: 25px;
        font-weight: bold;
      }
    }

    .checkout-perks {
      text-align: left;
      margin: 2rem 0;
      .perks-title {
        font-size: 25px;
      }
    }

    .checkout-info {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      .checkout-image {
        width: 50%;
        img {
          width: 50%;
        }
      }
      .checkout-reward {
        display: flex;
        .reward-title {
          margin: 0 20px;
        }
      }
    }
  }

  .content-left {
    border-left: 1px solid black;
    width: 50%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    .content-contribution {
      width: 50%;
      .subtotal-text {
        display: flex;
        justify-content: space-between;
      }
      .shipping-text {
        display: flex;
        justify-content: space-between;
      }
      .total-text {
        display: flex;
        justify-content: space-between;
        margin-top: 5rem;
        margin-bottom: 1rem;
      }
    }

    .btn-checkout {
      border-top: 1px solid black;
      width: 50%;
      margin: 1rem 0;

      button {
        margin: 1rem 0;
      }
    }
  }
}
</style>
