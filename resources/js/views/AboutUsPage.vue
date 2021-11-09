<template>
  <div class="aboutus-wrapper">
    <div class="image-wrapper">
      <img src="../assets/images/aboutus.jpg" alt="about-us-image">
    </div>
    <div class="text-wrapper">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. 
      Libero ut sequi ad veniam tempora dolorem quisquam labore quo inventore optio odit, 
      qui sint aliquam, aut quod sit? Alias, dolore vel?
    </div>
  </div>
</template>

<script>
export default {
  name: 'AboutUsPage',
}
</script>

<style lang="less" scoped>
.aboutus-wrapper {
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-bottom: 2rem;

  .image-wrapper {
    img {
      width: 33rem;
      height: 33rem;
    }
    margin-bottom: 2rem;
  }

  .text-wrapper {
    margin-top: 5rem;
    width: 50%;
    font-size: 26px;
    font-weight: 500;
    text-align: center;
  }
}

</style>