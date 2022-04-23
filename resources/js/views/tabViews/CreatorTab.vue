<template>
  <div class="wrap-creator-tab">
    <div class="title-creator">
      Collaborator List
    </div>
    <div class="creator-card">
      <div class="content-creator">
        <table>
          <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Country</th>
          </tr>
          <tr>
            <td>Alfreds Futterkiste</td>
            <td>Maria Anders</td>
            <td>Germany</td>
          </tr>
          <tr>
            <td>Centro comercial Moctezuma</td>
            <td>Francisco Chang</td>
            <td>Mexico</td>
          </tr>
          <tr>
            <td>Ernst Handel</td>
            <td>Roland Mendel</td>
            <td>Austria</td>
          </tr>
          <tr>
            <td>Island Trading</td>
            <td>Helen Bennett</td>
            <td>UK</td>
          </tr>
          <tr>
            <td>Laughing Bacchus Winecellars</td>
            <td>Yoshi Tannamuri</td>
            <td>Canada</td>
          </tr>
          <tr>
            <td>Magazzini Alimentari Riuniti</td>
            <td>Giovanni Rovelli</td>
            <td>Italy</td>
          </tr>
        </table>
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
  margin-bottom: 5rem;

  .title-creator {
    margin-top: 5rem;
    font-size: 30px;
    font-weight: bold;
    text-align: center;
  }

  .creator-card {
    border: 1px solid black;
    width: 50rem;
    min-height: 20rem;
    margin: 5rem 0;
    text-align: left;
    padding: 10px;

    .content-creator {
      font-size: 20px;
      table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
      }

      tr:nth-child(even) {
        background-color: #dddddd;
      }
    }
  }

}
</style>
