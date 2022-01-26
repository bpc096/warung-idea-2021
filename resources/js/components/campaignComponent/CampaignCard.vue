<template>
  <div class="campaign-card">
      <div class="campaign-image">
        image
      </div>
      <div class="campaign-content">
        <div class="campaign-title">
          Title Campaign
        </div>
        <div class="campaign-desc">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, quaerat.
        </div>
        <div class="campaign-donation-status">
          Donation Target
          <div class="shell">
            <div
              class="bar-progress"
              :style="{width: progressPercentage + '%'}"
            >
              <span>{{ progressPercentage }}%</span>
            </div>
          </div>
          <div class="campaign-wrap-button" v-if="!isInHistoryCampaignPage">
            <a
              href="/projectdetail/123"
              class="btn-view-campaign mr"
            >
             View Campaign
            </a>
          </div>
        </div>
        <div class="campaign-wrap-button" v-if="isInHistoryCampaignPage">
          <a href="/projectdetail/123" class="btn-view-campaign">
            View Campaign
          </a>
          <a href="/campaign/edit" class="btn-edit-campaign">
            Edit Campaign
          </a>
          <a href="#deleteCampaign" class="btn-delete-campaign">
            Delete Campaign
          </a>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  name: 'CampaignCard',
  props: {
    isInHistoryCampaignPage: {
      type: Boolean,
      default: true,
    }
  },
  data: () => {
    return {
      progress: '59',
    }
  },
  computed: {
    progressPercentage() {
      if(parseInt(this.progress) <= 0) {
        return '1'
      }
      else if (parseInt(this.progress) >= 100) {
        return '100'
      }
      else {
        return this.progress
      }
    },
    checkEligibleToEdit() {
      // TODO : Check Eligiblelity to edit campaign
      return true
    }
  }
}
</script>

<style lang="less" scoped>
.campaign-card {
    border: 1px solid black;
    display: flex;
    flex-direction: row;
    width: 50rem;
    min-height: 10rem;
    margin: 2rem 0;

    .campaign-image {
      width: 30%;
    }

    .campaign-content {
      display: flex;
      flex-direction: column;
      justify-content: space-between;

      .campaign-title {
        text-align: left;
        font-size: 20px;
        font-weight: bold;
        margin-top: 10px;
      }

      .campaign-desc {
        text-align: left;
        font-size: 15px;
        font-weight: lighter;
        margin: 10px 0;
      }

      .campaign-donation-status {
        display: flex;
        flex-direction: row;
        margin-bottom: 10px;
        align-items: center;

        .shell {
          width: 250px;
          border: 1px solid #aaa;
          border-radius: 13px;
          padding: 3px;
          margin-left: 20px;


          .bar-progress {
            background: linear-gradient(to right, #11998e, #38ef7d);
            height: 20px;
            width: 50%;
            border-radius: 9px;
            span {
              float: right;
              padding: 2px;
              color: black;
              font-size: 0.7em
            }
          }
        }
      }

      .campaign-wrap-button {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        margin: 10px 0;

        .btn-view-campaign {
          text-decoration: none;
          color: black;
          border: 1px solid pink;
          border-radius: 10px;
          padding: 5px;
          background-color: pink;
          &.mr {
            margin-left: 1rem;
          }
        }

        .btn-edit-campaign {
          text-decoration: none;
          color: black;
          border: 1px solid blueviolet;
          border-radius: 10px;
          padding: 5px;
          background-color: blueviolet;
          margin: 0 10px;
        }

        .btn-delete-campaign {
          text-decoration: none;
          color: black;
          border: 1px solid #FF1700;
          border-radius: 10px;
          padding: 5px;
          background-color: #FF1700;
        }
      }
    }
  }
</style>
