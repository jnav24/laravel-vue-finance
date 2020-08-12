<template>
    <div v-if="data && data.last_page > 1" class="flex flex-row justify-center items-center">
        <button
            class="rounded-full p-2 mr-4 text-sm h-10 w-10"
            :class="{'bg-dark-blue text-white': page === data.current_page, 'shadow-md bg-white text-dark-blue hover:bg-dark-blue hover:text-white': page !== data.current_page}"
            @click="goToPage(page)"
            type="button"
            v-for="(page, i) in data.last_page"
            :key="i">
            {{ page }}
        </button>
    </div>
</template>

<script>
    export default {
      created() {
        const [query, page] = window.location.search.split('=');

        if (page && +page > this.data.last_page) {
          this.goToPage(1);
        }
      },

      data() {
        return {};
      },

      methods: {
        goToPage(page) {
          window.location.href = `${window.location.origin}?page=${page}`;
        },
      },

      props: {
        data: { required: true }
      },
    }
</script>
