<template>
  <div class="project-main-card">
    <div class="card-image">
      image
    </div>
    <div class="card-content">
      <div class="card-title">
        Project Name Here
      </div>
      <div class="card-description">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
         Velit facilis consequuntur, laborum et unde quod corporis culpa illum pariatur eaque.
         Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, nam!
      </div>
      <div class="card-additional">
        <div class="creator-info">
          By Creator-name
        </div>
        <div class="icon-info">
          <div class="icon-love">
            <a href="#addToLove">
              <img src="../../assets/images/icon/love.png" alt="love-icon">
            </a>
          </div>
          <div class="icon-bookmark">
            <a href="#addToBookmark">
              <img src="../../assets/images/icon/bookmark.svg" alt="bookmark-icon">
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProjectMainCard',
  props: {
    projectData: {
      type: Object,
      default: {}
    }
  }
}
</script>

<style lang="less" scoped>
.project-main-card {
  height: 340px;
  width: 620px;
  display: flex;
  flex-direction: row;
  margin: 0 20px;
  border: 1px solid rgba(0,0,0,.5);
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;

  .card-image {
    width: 40%;
    height: 100%;
    background-color: pink;
  }

  .card-content {
    text-align: left;
    display: flex;
    flex-direction: column;
    height: 100%;
    margin-left: 10px;

    .card-title {
      margin-top: 2rem;
      font-size: 28px;
      font-weight: bold;
    }

    .card-description {
      margin: 2rem 0;
      width: 20rem;
    }

    .card-additional {
      height: 100%;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-items: flex-end;

      .creator-info {
        text-align: center;
        margin-bottom: 8px;
      }

      .icon-info {
        display: flex; 
        flex-direction: row;

        .icon-bookmark, .icon-love {
          margin: 0 6px;
          a {
            text-decoration: none;
          }
          img {
            height: 24px;
            width: 24px;
          }
        }
      }
    }
  }


}
</style>