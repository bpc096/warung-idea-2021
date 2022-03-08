<template>
  <div class="wrap-creator-tab">
    <div class="title-creator">
      Collaborator List
    </div>
    <div class="creator-card">
      <div class="content-creator">
        <ul>
          <li>Budiman Sudjiatmiko</li>
          <li>Andre Bodat</li>
          <li>Sugiarto Hartaono</li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CreatorTab'
}
</script>

<style lang="less" scoped>
.wrap-creator-tab{
  min-height: 70vh;
  display: flex;
  flex-direction: column;
  align-items: center;

  .title-creator {
    margin-top: 5rem;
    font-size: 30px;
    font-weight: bold;
    text-align: center;
  }

  .creator-card {
    border: 1px solid black;
    width: 50rem;
    height: 20rem;
    margin: 5rem 0;
    text-align: left;
    padding: 10px;

    .content-creator {
      font-size: 25px;
    }
  }

}
</style>
