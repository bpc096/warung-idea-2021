<template>
  <div class="aboutus-wrapper">
    <div class="image-wrapper">
      <img src="images/aboutus.jpg" alt="about-us-image">
    </div>
    <div class="text-wrapper">
      Terima kasih telah berkunjung & menggunakan <i>WarungIdea</i>. <i>WarungIdea</i> adalah media platform situs penggalangan dana berbasis IDE, Wujudkan IDE kamu dengan membuat kampanye,
      promosikan dan kumpulkan dana untuk kampanyemu, dan wujudkan kampanye tersebut bersama kami. Situs website ini dikembangkan oleh M Faisal Ghozi, Bill Petrus
      & Jeffrey Marcellino. <br> <b>Terima Kasih Sudah Berkunjung & Mari Wujudkan IDE-mu sekarang juga!</b>
      <div class="text-version">
        <p>App Version {{ appVersion }} <br> Copyright WarungIdea @2022</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AboutUsPage',
  data() {
    return {
      appVersion: '6.0.1'
    }
  }
}
</script>

<style lang="less" scoped>
.aboutus-wrapper {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding-bottom: 2rem;
  padding-top: 5rem;
  background-color: white;

  .image-wrapper {
    img {
      border-radius: 50%;
      width: 35rem;
      height: 35rem;
    }
    margin-top: 2rem;
    margin-bottom: 2rem;
  }

  .text-wrapper {
    margin-top: 5rem;
    margin-bottom: 5rem;
    width: 50%;
    font-size: 26px;
    font-weight: 500;
    text-align: center;

    .text-version {
      margin-top: 5rem;
      font-size: 20px;
      font-weight: 100;
    }
  }
}

</style>
