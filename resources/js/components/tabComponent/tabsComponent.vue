<template>
  <div>
    <div class="tabs">
      <div v-for="(tab,index) in tabs" :class="{ 'is-active': tab.isActive }" :key="index">
          <a :href="tab.href" @click="selectTab(tab)">{{ tab.name }}</a>
      </div>
    </div>
    <div class="tabs-details">
        <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: 'tabsComponent',
  data() {
    return {
      tabs: []
    }
  },
  created() {
    this.tabs = this.$children;
  },
  methods: {
    selectTab(selectedTab) {
      this.tabs.forEach(tab => {
        tab.isActive = (tab.name == selectedTab.name);
      });
    }
  }
}
</script>

<style lang="less" scoped>
.tabs {
  display: flex;
  flex-direction: row;
  background-color: #c4c4c4;
  color: black;
  justify-content: center;
  align-items: center;
  height: 3rem;

  a {
    text-decoration: none;
    color: black;
    margin: 0 5rem;

    &:hover {
      color: white;
    }
  }
}
</style>
