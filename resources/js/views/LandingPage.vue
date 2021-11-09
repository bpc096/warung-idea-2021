<template>
  <div class="landingPageWrapper">
    <div class="section first-section">
      <div class="text-info">
        <h1>WarungIde</h1>
        <h3>Share your idea to the world</h3>
      </div>
      <div class="image-info">
        <img src="../assets/images/section_test01.svg" alt="image-section-one">
      </div>
    </div>
    <div class="section second-section">
      <div class="image-info">
        <img src="../assets/images/section2.jpg" alt="image-section-two">
      </div>
      <div class="text-info">
        <h1>Our Mission</h1>
        <h3>
          To make world a better place to live, With Imagination and Ideas.
          We are here to make your ideas happen. <br><br>
          - Ideas, Creativity, Innovative -
        </h3>
      </div>
    </div>
    <div class="section third-section">
      <div class="text-info">
        <h1>Our Vision</h1>
        <h3>
          Imagination is one of the greatest human ability to achieve our prosperity in the world.
          We are here to helping you create a better understanding about idea & make your idea come true<br><br>
          - Unity, Stabillity, Agillity -
        </h3>
      </div>
      <div class="image-info">
        <img src="../assets/images/section3.svg" alt="image-section-three">
      </div>
    </div>
    <div class="section four-section">
      <div class="image-info">
        <img src="../assets/images/section4.jpg" alt="image-section-four">
      </div>
      <div class="text-info">
        <h1>Our Ideas</h1>
        <h3>
          Our presence here, to help you achieve your financial goals to make your dream come true.
          Spread your ideas, and let the world support you to realize your idea. <br><br>
          - Helping, Caring, Supporting -
        </h3>
      </div>
    </div>
    <div class="team-section">
      <h1 class="team-title">Our Team</h1>
      <div class="member-section">
        <div class="member">
          <div class="member-image">
            <img src="../assets/images/team/bill.jpg" alt="bill-petrus-team-01">
          </div>
          <div class="member-name">
            Bill Petrus - Backend Engineer
          </div>
        </div>
        <div class="member">
          <div class="member-image">
            <img src="../assets/images/team/jeffrey.jpg" alt="jeffrey-team-02">
          </div>
          <div class="member-name">
            Jeffrey Marcellino - Database Engineer
          </div>
        </div>
        <div class="member">
          <div class="member-image">
            <img src="../assets/images/team/ghozi.jpg" alt="ghozi-team-03">
          </div>
          <div class="member-name">
            M Faisal Ghozi - Frontend Engineer
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'LandingPage',
}
</script>

<style lang="less" scoped>
.landingPageWrapper {

  .section {
    height: 95vh;
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    .image-info {
      img {
        border-radius: 20px;
        width: 25rem;
        height: 25rem;
      }
    }
    h1 {
      font-size: 64px;
    }
    h3 {
      font-size: 18px;
    }
  }

  .first-section {
    .text-info > h3 {
      font-size: 48px;
      font-style: italic;
      font-weight: lighter;
    }
  }

  .first-section, .third-section, .team-section {
    background-color: #D8F2FF;
  }

  .second-section, 
  .third-section, 
  .four-section {
    .text-info {
      width: 35rem;
    }
  }

  .team-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 95vh;
    h1 {
      font-size: 4rem;
    }
    .member-section {
      display: flex;
      flex-direction: row;
      justify-content: space-around;
      align-items: center;
      width: 100%;
      height: 55%;

      .member {
        margin: 0 20px;
        width: 23rem;
        height:  28rem;
        border-radius: 20px;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-color: white;

        &:hover {
          box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        .member-image {
          width: 100%;
          height: 60%; 
          img {
            height: 100%;
            border-radius: 10px;
          }
        }

        .member-name {
          font-weight: 500;
          margin-top: 2rem;
          color: black;
          font-style: italic;
          font-size: 18px;
        }
      }
    }

  }
}
</style>>