<template>
    <div class="flex items-center justify-end px-5 py-8">
        <p class="text-red-600 mr-4" v-if="error">{{ error }}</p>
        <Loader v-if="showLoader" />
        <button
            class="rounded-md bg-pale-blue text-dark-pale-blue px-6 py-4 text-lg mr-4"
            type="button"
            @click="$emit('closeAction', false)">
            {{ closeBtn }}
        </button>
        <button
            class="rounded-md px-6 py-4 text-lg"
            type="button"
            @click="$emit('closeAction', true)"
            :class="{'bg-blue text-white': canSubmit, 'bg-gray-400 text-gray-600 cursor-text': !canSubmit}"
            :disabled="!canSubmit">
            {{ saveBtn }}
        </button>
    </div>
</template>

<script>
    import Loader from './Loader.vue'
    export default {
      components: {
        Loader,
      },

      methods: {
        closeAction() {},
      },

      props: {
        canSubmit: { required: true },
        closeBtn: { default: 'Cancel' },
        error: { default: null },
        saveBtn: { default: 'Save' },
        showLoader: { default: false },
      },
    }
</script>
