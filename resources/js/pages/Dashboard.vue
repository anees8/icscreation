<script setup>
import { defineAsyncComponent } from 'vue'

const HomeCards = defineAsyncComponent(() =>
  import('./Home/HomeCards.vue')
)
</script>
<template>
<BContainer fluid>
    <BRow>
<HomeCards/>
</BRow>
</BContainer>
</template>