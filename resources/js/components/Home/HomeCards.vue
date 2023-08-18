<script setup>
import { defineAsyncComponent } from 'vue'

const CardItem = defineAsyncComponent(() =>
  import('./CardItem.vue')
)
</script>
<template>
    <div class="container">
        <CardItem/>
    </div>
</template>