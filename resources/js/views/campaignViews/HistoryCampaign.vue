<template>
  <div class="history-campaign-wrap">
    history campaign page
    <div class="campaign-card">
      <div class="campaign-image">
        image
      </div>
      <div class="campaign-content">
        <div class="campaign-desc">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, quaerat.
        </div>
        <div class="campaign-donation-status">
          <div class="bar">--</div>
          <div class="bar-text">88%</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HistoryCampaign'
}
</script>

<style lang="less" scoped>
.history-campaign-wrap {
  min-height: 90vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;

  .campaign-card {
    border: 1px solid black;
    display: flex;
    flex-direction: row;
    width: 5rem;
    height: 3rem;

    .campaign-content {
      display: flex;
      flex-direction: column;

      .campaign-donation-status {
        display: flex;
        flex-direction: row;
      }
    }


  }

}
</style>
