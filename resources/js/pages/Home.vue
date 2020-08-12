<template>
    <div>
        <Nav />
        <Summary />

        <div class="container mx-auto py-12">
            <template v-for="[time, data] in Object.entries(expenses)">
                <Expense :data="data" :datetime="time" />
            </template>
        </div>
    </div>
</template>

<script>
    import Expense from '../components/Expense.vue';
    import Nav from '../components/Nav.vue';
    import Summary from '../components/Summary.vue';

    export default {
      components: {
        Expense,
        Summary,
        Nav,
      },
      data() {
        return {
          expenses: {
            '2020-08-11': [
              {
                name: 'Groceries',
                created_at: '2020-07-31 13:51:49',
                amount: '-60.00'
              },
              {
                name: 'Groceries',
                created_at: '2020-07-31 13:51:49',
                amount: '-40.00'
              }
            ],
            '2020-08-10': [
              {
                name: 'Groceries',
                created_at: '2020-07-31 13:51:49',
                amount: '60.00'
              }
            ],
            '2020-08-09': [
              {
                name: 'Groceries',
                created_at: '2020-07-31 13:51:49',
                amount: '-60.00'
              }
            ],
            '2020-08-08': [
              {
                name: 'Groceries',
                created_at: '2020-07-31 13:51:49',
                amount: '-60.00'
              }
            ],
          },
        };
      },
    }
</script>
