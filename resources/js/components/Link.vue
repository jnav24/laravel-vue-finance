<template>
    <button type="button" class="text-blue underline mr-5" @click="$emit('onClick')">{{ name }}</button>
</template>

<script>
    export default {
      props: {
        name: { required: true },
      }
    }
</script>
