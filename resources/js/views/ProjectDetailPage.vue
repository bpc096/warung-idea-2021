<template>
  <div class="project-detail-page">
    <div class="wrap-title">
      <div class="main-title">Project Title</div>
      <div class="main-desc">Project Description</div>
    </div>
    <div class="wrap-main-section">
      <div class="project-detail-section">
        <div class="progress-bar"></div>
        <div class="total-donate-info">
          Rp 1.000.000 dari Rp 10.000.000 (10%)
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
      Tab
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProjectDetail',

}
</script>

<style lang="less" scoped>
.project-detail-page {
  height: 90vh;
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
      width: 50%;
      height: 50vh;
      text-align: left;
    }
    .project-image-section{
      width: 50%;
      height:50vh;
      display: flex;
      justify-content: center;
      align-items: center;
      .image {
        width: 50px;
        height: 50px;
        background-color: blue;
      }
    }
  }

}
</style>
