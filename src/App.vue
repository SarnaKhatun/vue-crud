<template>
  <MyHeader />
  <router-view/>
</template>

<script>
import MyHeader from "@/components/MyHeader";
export default {
  name: 'App',
  components: {MyHeader}
}
</script>

<style scoped>

</style>
