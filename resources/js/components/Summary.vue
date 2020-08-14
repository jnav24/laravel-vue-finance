<template>
    <section class="bg-dark-blue">
        <AddEntryModal v-if="showAddEntryModal" @close="showAddEntryModal = false" />
        <ImportCSVModal v-if="showImportCsvModal" @close="showImportCsvModal = false" />

        <div class="container mx-auto py-10 flex justify-between">
            <div class="flex items-center">
                <h1 class="text-3xl font-display text-white tracking-wider mr-4">Your Balance</h1>
                <Button name="Add Entry" icon="add" custom-class="h-3" :disabled="disableButton" @onClick="showAddEntryModal = true" />
                <Button name="Import CSV" icon="import" custom-class="h-7 transform -translate-y-2" :disabled="disableButton" @onClick="showImportCsvModal = true" />
            </div>

            <div class="text-right">
                <p class="font-body text-gray-500 uppercase tracking-wide">Total Balance</p>
                <p class="text-4xl font-body" :class="{'text-green': total >= 0, 'text-gray-500': total < 0}">
                    {{ totalDollarAmount(total) }}.<span class="text-2xl">{{ getDecimalValue(total) }}</span>
                </p>
            </div>
        </div>
    </section>
</template>

<script>
    import Button from './Button.vue';
    import { TOTAL_AMOUNT, RESET_TOTAL, DISABLE_ENTRIES } from '../constants';
    import AddEntryModal from './AddEntryModal.vue';
    import common from '../mixins/common';
    import ImportCSVModal from './ImportCSVModal';

    export default {
      components: {
        ImportCSVModal,
        AddEntryModal,
        Button,
      },

      created() {
        this.$bus.$on(TOTAL_AMOUNT, (data) => {
          this.total += Number(data);
        });

        this.$bus.$on(RESET_TOTAL, () => {
          this.total = 0;
        });

        this.$bus.$on(DISABLE_ENTRIES, data => {
          this.disableButton = data;
        });
      },

      data() {
        return {
          disableButton: false,
          showAddEntryModal: false,
          showImportCsvModal: true,
          total: 0,
        };
      },

      mixins: [common],
    }
</script>
