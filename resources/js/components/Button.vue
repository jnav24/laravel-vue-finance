<template>
    <button
        class="flex items-center px-3 py-3 mr-4 rounded-lg shadow-lg text-sm focus:outline-none uppercase font-body"
        :class="{'bg-blue text-white': !disabled, 'bg-gray-400 text-gray-600 cursor-text': disabled}"
        :disabled="disabled"
        @click="$emit('onClick')"
        type="button">
        <div class="overflow-hidden h-3 w-6 mr-2">
            <img :src="`/images/${icon}.svg`" alt="" class="w-auto block mr-4" :class="customClass" />
        </div>
        <span>{{ name }}</span>
    </button>
</template>

<script>
    export default {
      props: {
        disabled: {
          default: false,
        },
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
