<template>
  <div class="project-detail-page">
    <div class="wrap-title">
      <div class="main-title">Project Title</div>
      <div class="main-desc">Project Description</div>
    </div>
    <div class="wrap-main-section">
      <div class="project-detail-section">
        <div class="progress-bar-custom">
          <div class="progress-color-custom"></div>
        </div>
        <div class="total-donate-info">
          Rp 1.000.000 dari Rp 10.000.000
        </div>
        <div class="supporter-info">
          270 Penyumbang
        </div>
        <div class="day-left-info">
          25 Hari lagi
        </div>
        <div class="button-wrapper">
          <div class="btn-support">
            Support Now
          </div>
          <div class="btn-remind">
            Remind Me Later
          </div>
        </div>
      </div>
      <div class="project-image-section">
        <div class="image"></div>
      </div>
    </div>
    <div class="wrap-tab-section">
      <tabs>
        <tab name="Campaign" :selected="true">
          <campaignTab />
        </tab>
        <tab name="Updates">
          <updateTab />
        </tab>
        <tab name="FAQ">
          <faqTab />
        </tab>
      </tabs>
    </div>
  </div>
</template>

<script>
// Tab Component
import tab from  '../components/tabComponent/tabComponent.vue'
import tabs from '../components/tabComponent/tabsComponent.vue'

// Content Tab Component
import campaignTab from '../views/tabViews/CampaignTab.vue'
import updateTab from '../views/tabViews/UpdateTab.vue'
import faqTab from '../views/tabViews/FaqTab.vue'

export default {
  name: 'ProjectDetail',
  components: {
    tab,
    tabs,
    campaignTab,
    updateTab,
    faqTab,
  }
}
</script>

<style lang="less" scoped>
.project-detail-page {
  .wrap-title {
    margin-bottom: 2rem;
    .main-title {
      font-size: 4rem;
    }
  }

  .wrap-main-section{
    border: 1px solid black;
    display: flex;
    flex-direction: row;
    width: 100%;
    .project-detail-section{
      width: 100%;
      height: 40vh;
      text-align: left;
      margin: 3rem 0 3rem 3rem;
      font-size: 1.5rem;

      .progress-bar-custom{
        width: 20rem;
        height: 1.5rem;
        border: 2px solid black;
        margin-bottom: 30px;

        .progress-color-custom{
          width: 50%;
          height: 100%;
          background-color: green;
        }
      }

      .total-donate-info{
        margin-bottom: 30px;
      }

      .supporter-info{
        display: flex;
        flex-direction: row;
        margin-bottom: 30px;
      }

      .day-left-info{
        margin-bottom: 30px;
      }

      .button-wrapper {
        display: flex;
        flex-direction: row;

        .btn-support{
          border: 1px solid black;
          border-radius: 25px;
          padding: 10px;
          margin-right: 1rem;
          &:hover{
            background-color: black;
            color: white;
          }
        }

        .btn-remind{
          margin: 0 .5rem;
          border: 1px solid black;
          border-radius: 25px;
          padding: 10px;

          &:hover{
            background-color: black;
            color: white;
          }
        }
      }
    }
    .project-image-section{
      width: 100%;
      height: 50vh;
      display: flex;
      justify-content: center;
      align-items: center;
      .image {
        width: 80%;
        height: 80%;
        background-color: blue;
      }
    }
  }
}
</style>
