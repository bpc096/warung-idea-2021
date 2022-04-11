<template>
  <div class="wrap-payment-tab">
    <div class="title-tab">
      Donation Payment List
    </div>
    <div class="payment-card">
      <div class="content-contributor">
        <table>
          <tr>
            <th>No</th>
            <th>Username</th>
            <th>Amount</th>
          </tr>
          <tr>
            <td>1</td>
            <td>Maria Anders</td>
            <td>Germany</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Francisco Chang</td>
            <td>Mexico</td>
          </tr>
          <tr>
            <td3</td>
            <td>Roland Mendel</td>
            <td>Austria</td>
          </tr>
          <tr>
            <td>4</td>
            <td>Helen Bennett</td>
            <td>UK</td>
          </tr>
          <tr>
            <td>5</td>
            <td>Yoshi Tannamuri</td>
            <td>Canada</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PaymentTab'
}
</script>

<style lang="less" scoped>
.wrap-payment-tab{
  min-height: 70vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 5rem;

  .title-tab {
    margin-top: 5rem;
    font-size: 30px;
    font-weight: bold;
    text-align: center;
  }

  .payment-card {
    border: 1px solid black;
    width: 50rem;
    min-height: 20rem;
    margin: 5rem 0;
    text-align: left;
    padding: 10px;

    .content-contributor {
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
