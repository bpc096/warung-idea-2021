<template>
  <div>
    <div class="tabs">
      <div v-for="(tab,index) in tabs" :class="['tab-wrap', {'is-active': tab.isActive }]" :key="index">
          <a :href="tab.href" @click="selectTab(tab)">{{ tab.name }}</a>
          <div :class="{'border-active': tab.isActive}"></div>
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

  .tab-wrap {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  a {
    text-decoration: none;
    color: black;
    margin: 0 5rem;
    transition: 0.5s;


    &:hover {
      color: white;
      border-bottom: 1px solid black;
      width: 60%;
    }
  }

  .border-active {
    border-bottom: 2px solid black;
    width: 60%;
  }
}
</style>
