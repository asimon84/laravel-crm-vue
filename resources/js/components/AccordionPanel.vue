<template>
  <div class="accordion-panel">
    <div class="accordion-header" @click="togglePanel">
      <h3>{{ title }}</h3>
      <span>{{ isOpen ? '▲' : '▼' }}</span>
    </div>
    <div class="accordion-content" v-show="isOpen">
      <slot></slot>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
  title: {
    type: String,
    required: true,
  },
});

const isOpen = ref(false);

const togglePanel = () => {
  isOpen.value = !isOpen.value;
};
</script>

<style scoped>
.accordion-panel {
  border-bottom: 1px solid #eee;
}

.accordion-panel:last-child {
  border-bottom: none;
}

.accordion-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 15px;
  background-color: #f0f0f0;
  cursor: pointer;
}

.accordion-header h3 {
  margin: 0;
  font-size: 1.1em;
}

.accordion-content {
  padding: 15px;
  background-color: #fff;
}
</style>