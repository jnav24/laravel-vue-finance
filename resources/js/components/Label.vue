<template>
    <label class="block uppercase text-gray-700 mb-2 font-body">{{ label }}</label>
</template>

<script>
    export default {
      props: {
        label: { required: true },
      },
    }
</script>
