<template>
    <div class="bg-alert border-dark-alert border-2 rounded-md p-4 mb-12 flex flex-row justify-center items-center">
        <div class="overflow-hidden w-8 h-8 mr-4">
            <LoaderCircle />
        </div>
        <p class="font-body text-white text-2xl">{{ msg }}</p>
    </div>
</template>

<script>
    import LoaderCircle from './LoaderCircle.vue';

    export default {
      components: {
        LoaderCircle,
      },

      props: {
        msg: { required: true }
      },
    }
</script>
