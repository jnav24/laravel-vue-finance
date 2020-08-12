<template>
    <div>
        <Nav />
        <Summary />

        <div class="container mx-auto py-12">
            <template v-if="!modifying">
                <Expense
                    v-for="[time, data] in Object.entries(expenses)"
                    :key="data.id"
                    :data="data"
                    :datetime="time"
                />
            </template>
        </div>
    </div>
</template>

<script>
    import Expense from '../components/Expense.vue';
    import Nav from '../components/Nav.vue';
    import Summary from '../components/Summary.vue';
    import { DELETE_ENTRY, RESET_TOTAL, UPDATE_ENTRY } from '../constants';
    import { DateTime } from 'luxon';

    export default {
      components: {
        Expense,
        Summary,
        Nav,
      },

      created() {
        this.$bus.$on(UPDATE_ENTRY, (data) => {
          this.modifying = true;
          const dt = DateTime.fromSQL(data.created_at).toFormat('yyyy-MM-dd');

          if (this.expenses[dt]) {
            this.$bus.$emit(RESET_TOTAL);
            const index = this.expenses[dt].findIndex(obj => obj.id === data.id);

            if (index > -1) {
              this.$set(this.expenses[dt], index, data);
            }
          }

          setTimeout(() => this.modifying = false, 100);
        });

        this.$bus.$on(DELETE_ENTRY, (data) => {
          this.modifying = true;
          const dt = DateTime.fromSQL(data.created_at).toFormat('yyyy-MM-dd');

          if (this.expenses[dt]) {
            this.$bus.$emit(RESET_TOTAL);
            this.expenses = {
              ...this.expenses,
              [dt]: this.expenses[dt].filter(obj => obj.id !== data.id),
            };
          }

          setTimeout(() => this.modifying = false, 100);
        });
      },

      data() {
        return {
          modifying: false,
          expenses: {
            '2020-08-11': [
              {
                id: 1,
                name: 'Groceries',
                created_at: '2020-08-11 13:51:49',
                amount: '-60.99'
              },
              {
                id: 2,
                name: 'Groceries',
                created_at: '2020-08-11 13:51:49',
                amount: '-40.42'
              }
            ],
            '2020-08-10': [
              {
                id: 3,
                name: 'Groceries',
                created_at: '2020-08-10 13:51:49',
                amount: '60.31'
              }
            ],
            '2020-08-09': [
              {
                id: 4,
                name: 'Groceries',
                created_at: '2020-08-09 13:51:49',
                amount: '-60.77'
              }
            ],
            '2020-08-08': [
              {
                id: 5,
                name: 'Groceries',
                created_at: '2020-08-08 13:51:49',
                amount: '-60.00'
              }
            ],
          },
        };
      },
    }
</script>
