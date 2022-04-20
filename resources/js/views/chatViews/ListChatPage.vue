<template>
  <div class="list-chat-page">
    <div class="user-wrap">
      <div class="user-card">
        <div class="user-image">
          <img src="https://us.123rf.com/450wm/apoev/apoev1902/apoev190200141/125038134-person-gray-photo-placeholder-man-in-a-costume-on-gray-background.jpg?ver=6" alt="">
        </div>
        <div class="user-name">
          <b>M Faisal Ghozi</b>
        </div>
      </div>
      <div class="user-card">
        <div class="user-image">
          <img src="https://us.123rf.com/450wm/apoev/apoev1902/apoev190200141/125038134-person-gray-photo-placeholder-man-in-a-costume-on-gray-background.jpg?ver=6" alt="">
        </div>
        <div class="user-name">
          <b>Bill Petrus</b>
        </div>
      </div>
      <div class="user-card">
        <div class="user-image">
          <img src="https://us.123rf.com/450wm/apoev/apoev1902/apoev190200141/125038134-person-gray-photo-placeholder-man-in-a-costume-on-gray-background.jpg?ver=6" alt="">
        </div>
        <div class="user-name">
          <b>Jeffrey Marcellino</b>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ListChatPage'
}
</script>

<style lang="less" scoped>
.list-chat-page {
  min-height: 90vh;
  width: 100%;

  .user-wrap {
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;

    .user-card {
      display: flex;
      flex-direction: row;
      height: 5rem;
      width: 100%;
      border: 1px solid grey;
      align-items: center;
      margin: 10px 0;

      &:first-child {
        margin-top: 0;
      }

      .user-image {
        width: 30%;
        background-color: grey;
        height: 100%;

        img {
          width: 5rem;
          height: 4.5rem;
          border-radius: 50%;
        }
      }
      .user-name {
        width: 70%;
      }
    }
  }

}
</style>
