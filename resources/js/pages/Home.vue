<template>
    <div>
        <Nav />
        <Summary />

        <div class="container mx-auto py-12">
            <template v-if="!deleting">
                <Expense
                    v-for="[time, data] in Object.entries(expenses)"
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
    import { DELETE_ENTRY, RESET_TOTAL } from '../constants';
    import { DateTime } from 'luxon';

    export default {
      components: {
        Expense,
        Summary,
        Nav,
      },
      created() {
        this.$bus.$on(DELETE_ENTRY, (data) => {
          this.deleting = true;
          const dt = DateTime.fromSQL(data.created_at).toFormat('yyyy-MM-dd');

          if (this.expenses[dt]) {
            this.$bus.$emit(RESET_TOTAL);
            this.expenses = {
              ...this.expenses,
              [dt]: this.expenses[dt].filter(obj => obj.id !== data.id),
            };
          }

          setTimeout(() => this.deleting = false, 100);
        });
      },
      data() {
        return {
          deleting: false,
          expenses: {
            '2020-08-11': [
              {
                id: 1,
                name: 'Groceries',
                created_at: '2020-08-11 13:51:49',
                amount: '-60.00'
              },
              {
                id: 2,
                name: 'Groceries',
                created_at: '2020-08-11 13:51:49',
                amount: '-40.00'
              }
            ],
            '2020-08-10': [
              {
                id: 3,
                name: 'Groceries',
                created_at: '2020-08-10 13:51:49',
                amount: '60.00'
              }
            ],
            '2020-08-09': [
              {
                id: 4,
                name: 'Groceries',
                created_at: '2020-08-09 13:51:49',
                amount: '-60.00'
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
