<template>
  <h4>
    Showing {{ results.from }} to {{ results.to }} of {{ results.total }} page
    {{ results.current_page }} of {{ results.last_page }}
  </h4>
</template>

<script>
export default {
  props: ["results"],
};
</script>
