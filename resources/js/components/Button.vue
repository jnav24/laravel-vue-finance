<template>
    <button class="bg-blue text-white flex items-center px-3 py-3 mr-4 rounded-lg shadow-lg text-sm focus:outline-none uppercase font-body" type="button">
        <div class="overflow-hidden h-3 w-6 mr-2">
            <img :src="`/images/${icon}.svg`" alt="" class="w-auto block mr-4" :class="customClass" />
        </div>
        <span>{{ name }}</span>
    </button>
</template>

<script>
    export default {
      props: {
        name: {
          required: true,
        },
        icon: {
          required: true,
        },
        customClass: {
          default: null
        },
      },
    }
</script>
