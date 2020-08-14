<template>
    <div class="container mx-auto py-12">
        <template v-if="!modifying">
            <Expense
                v-for="[time, data] in Object.entries(expenseData.data)"
                :key="data.id"
                :data="data"
                :datetime="time"
            />
        </template>

        <Paginate :data="expenseData" />
    </div>
</template>

<script>
  import Expense from '../components/Expense.vue';
  import Nav from '../components/Nav.vue';
  import Summary from '../components/Summary.vue';
  import Paginate from '../components/Paginate.vue';
  import { RESET_ENTRY, DELETE_ENTRY, RESET_TOTAL, UPDATE_ENTRY, SET_ROW_COUNT } from '../constants';
  import { DateTime } from 'luxon';

  export default {
    components: {
      Expense,
      Paginate,
      Summary,
      Nav,
    },

    created() {
      this.expenseData = JSON.parse(JSON.stringify(this.expenses));

      this.$bus.$on(UPDATE_ENTRY, (data) => {
        this.modifying = true;
        const dt = DateTime.fromSQL(data.entry_date).toFormat('yyyy-MM-dd');

        if (this.expenseData[dt]) {
          this.$bus.$emit(RESET_TOTAL);
          const index = this.expenseData[dt].findIndex(obj => obj.id === data.id);

          if (index > -1) {
            this.$set(this.expenseData[dt], index, data);
          }
        }

        setTimeout(() => this.modifying = false, 100);
      });

      this.$bus.$on(DELETE_ENTRY, (data) => {
        this.modifying = true;
        const dt = DateTime.fromSQL(data.entry_date).toFormat('yyyy-MM-dd');

        if (this.expenseData[dt]) {
          this.$bus.$emit(RESET_TOTAL);
          this.expenseData = {
            ...this.expenseData,
            [dt]: this.expenseData[dt].filter(obj => obj.id !== data.id),
          };
        }

        setTimeout(() => this.modifying = false, 100);
      });

      this.$bus.$on(RESET_ENTRY, (data) => {
        this.modifying = true;
        this.expenseData = data.data;
        setTimeout(() => this.modifying = false, 100);
      });

      this.$bus.$on(SET_ROW_COUNT, data => {
        this.csvRowCount = data;
      });
    },

    data() {
      return {
        csvRowCount: 0,
        expenseData: {},
        modifying: false,
      };
    },

    props: {
      expenses: { required: true },
    },
  }
</script>
