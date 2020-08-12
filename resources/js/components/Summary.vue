<template>
    <section class="bg-dark-blue">
        <div class="container mx-auto py-10 flex justify-between">
            <div class="flex items-center">
                <h1 class="text-2xl font-display text-white tracking-wider mr-4">Your Balance</h1>
                <Button name="Add Entry" icon="add" custom-class="h-3" />
                <Button name="Import CSV" icon="import" custom-class="h-7 transform -translate-y-2" />
            </div>

            <div class="font-body text-right">
                <p class="text-gray-500 uppercase tracking-wide">Total Balance</p>
                <p class="text-4xl" :class="{'text-green': total >= 0, 'text-gray-500': total < 0}">
                    {{ totalDollarAmount(total) }}.<span class="text-2xl">{{ getDecimalValue(total) }}</span>
                </p>
            </div>
        </div>
    </section>
</template>

<script>
    import Button from './Button.vue';
    import { TOTAL_AMOUNT, RESET_TOTAL } from '../constants';
    import common from '../mixins/common';

    export default {
      components: {
        Button,
      },

      created() {
        this.$bus.$on(TOTAL_AMOUNT, (data) => {
          this.total += Number(data);
        });

        this.$bus.$on(RESET_TOTAL, () => {
          this.total = 0;
        });
      },

      data() {
        return {
          total: 0,
        };
      },

      mixins: [common],
    }
</script>
