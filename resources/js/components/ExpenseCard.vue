<template>
    <div id="expense-card" class="bg-white rounded-lg shadow-md mt-5 flex flex-row justify-between px-5 py-3 items-center">
        <div>
            <p class="text-black font-title text-lg">{{ data.name }}</p>
            <p class="text-sm text-gray-500 font-subtitle">{{ setDatetime(data.created_at) }}</p>
        </div>

        <div>
            <p v-if="data.amount < 0" class="text-black font-amount text-lg">- ${{ data.amount }}</p>
            <p v-if="data.amount >= 0" class="text-green font-amount text-lg">+ ${{ data.amount }}</p>
        </div>
    </div>
</template>

<script>
  import { DateTime } from 'luxon';

  export default {
    props: {
      data: {
        required: true,
      },
    },
    methods: {
      setDatetime(value) {
        const dt = DateTime.fromSQL(value);
        return `${dt.toFormat('dd MMMM, yyyy')} at ${dt.toFormat('t')}`;
      }
    },
  }
</script>
