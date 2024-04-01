<template>
  <div v-if="loadingDiv" class="loading fade" :class="{'show':loading}">
    <div class="spinner"></div>
  </div>
</template>

<script>
export default {
  props: [
    'loading'
  ],
  data() {
    return {
      loadingDiv: true // Initially, loading is set to false
    };
  },
  updated() {
    if (this.loading === false) {
      setTimeout(() => {
        this.loadingDiv = false
      }, 200)
    }
  },
};
</script>

<style>
.loading {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 99999999999999;
}

.spinner {
  border: 4px solid #f3f3f3;
  border-top: 4px solid #3498db;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
