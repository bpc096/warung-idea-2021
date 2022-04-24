<template>
  <div class="wrap-campaign-tab">
    <div class="background-section">
      <div class="background-title">
        Background Project
      </div>
      <div class="background-content">
        {{ projectDesc }}
      </div>
    </div>
    <div class="design-plan-section">
      <div class="design-plan-title">
        Project Design & Plan
      </div>
      <div class="design-plan-content">
        {{ projectPlan }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CampaignTab',
  props: {
    projectDesc: {
      type: String,
      default: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae obcaecati esse, culpa dolor tempora consequuntur quisquam corporis nesciunt vel adipisci laboriosam optio ratione maxime, quod reprehenderit commodi laudantium. Ut vero illum ipsa porro ratione officia corporis, delectus voluptatibus debitis perspiciatis aperiam omnis quo corrupti earum expedita quae, impedit reprehenderit? Illo nemo, inventore laboriosam sit tempora in quisquam voluptates sunt ratione numquam delectus facere magnam quibusdam quo nulla, obcaecati perferendis facilis aperiam accusantium soluta explicabo. Autem nihil explicabo quos ea, repellat doloremque itaque ipsam consectetur asperiores ab quae, totam magni doloribus nobis vitae labore nulla fugit dolorem officiis a! Vitae, ad!'
    },
    projectPlan : {
      type: String,
      default: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae obcaecati esse, culpa dolor tempora consequuntur quisquam corporis nesciunt vel adipisci laboriosam optio ratione maxime, quod reprehenderit commodi laudantium. Ut vero illum ipsa porro ratione officia corporis, delectus voluptatibus debitis perspiciatis aperiam omnis quo corrupti earum expedita quae, impedit reprehenderit? Illo nemo, inventore laboriosam sit tempora in quisquam voluptates sunt ratione numquam delectus facere magnam quibusdam quo nulla, obcaecati perferendis facilis aperiam accusantium soluta explicabo. Autem nihil explicabo quos ea, repellat doloremque itaque ipsam consectetur asperiores ab quae, totam magni doloribus nobis vitae labore nulla fugit dolorem officiis a! Vitae, ad!'
    }
  }
}
</script>

<style lang="less" scoped>
.wrap-campaign-tab{
  min-height: 70vh;
  text-align: left;
  padding: 0 20rem;

  .background-section {
    margin: 4rem 0;
    .background-title {
      font-size: 30px;
      font-weight: bold;
    }
  }

  .design-plan-section {
    margin: 4rem 0;
    .design-plan-title {
      font-size: 30px;
      font-weight: bold;
    }
  }



}
</style>
