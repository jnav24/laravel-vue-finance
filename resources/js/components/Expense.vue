<template>
    <div id="expense" class="mb-12" v-if="data.length">
        <div class="flex flex-row justify-between px-4">
            <p class="uppercase font-title text-gray-600 tracking-wide">{{ humanDate }}</p>
            <p class="font-amount text-lg" :class="{'text-green': total >= 0, 'text-gray-600': total < 0}">
                {{ totalDollarAmount(total) }}.<span class="text-sm">{{ getDecimalValue(total) }}</span>
            </p>
        </div>

        <ExpenseCard
            v-for="expense in data"
            :key="expense.id"
            :data="expense"
            @setTotal="totalAmount = $event"
        />
    </div>
</template>

<script>
    import { DateTime } from 'luxon';
    import common from '../mixins/common';
    import ExpenseCard from './ExpenseCard.vue';
    import { TOTAL_AMOUNT } from '../constants';

    export default {
      components: {
        ExpenseCard,
      },

      props: {
        data: {
          required: true,
        },
        datetime: {
          required: true,
        },
      },

      computed: {
        humanDate: function () {
          const today = DateTime.local();
          const dt = DateTime.fromSQL(this.datetime);

          if (today.diff(dt, 'days').values.days < 2) {
            return dt.toRelativeCalendar();
          } else {
            return dt.toFormat('EEE, dd MMMM');
          }
        },
      },

      created() {
        this.total = this.arrayColumn('amount', this.data).reduce((a, b) => a + Number(b), 0);
        this.$bus.$emit(TOTAL_AMOUNT, this.total);
      },

      data() {
        return {
          total: 0,
        };
      },

      mixins: [common]
    }
</script>
