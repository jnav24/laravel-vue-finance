<template>
    <div id="expense-card" class="bg-white rounded-lg shadow-md mt-5">
        <div class="flex flex-row justify-between px-5 py-3 items-center">
            <div class="flex-auto">
                <p class="text-black font-title text-lg">{{ data.name }}</p>
                <p class="text-sm text-gray-500 font-subtitle">{{ setDatetime(data.created_at) }}</p>
            </div>

            <div class="flex-auto flex justify-end">
                <div class="actions mr-10" v-if="!editMode">
                    <Link name="Edit" @onClick="editEntry()" />
                    <Link name="Delete" @onClick="deleteEntry()" />
                </div>

                <p class="font-amount text-lg" :class="{'text-green': data.amount >= 0, 'text-black': data.amount < 0}">
                    {{ totalDollarAmount(data.amount) }}.<span class="text-sm">{{ getDecimalValue(data.amount) }}</span>
                </p>
            </div>
        </div>

        <EditExpense
            v-if="editMode"
            :data="data"
            @close="closeEditMode($event)"
        />
    </div>
</template>

<script>
  import { DateTime } from 'luxon';
  import Link from './Link';
  import { DELETE_ENTRY, UPDATE_ENTRY } from '../constants';
  import EditExpense from './EditExpense.vue';
  import common from '../mixins/common';

  export default {
    components: {
      EditExpense,
      Link,
    },

    props: {
      data: {
        required: true,
      },
    },

    data() {
      return {
        editMode: false,
      };
    },

    methods: {
      editEntry() {
        this.editMode = true;
      },

      deleteEntry() {
        this.$bus.$emit(DELETE_ENTRY, this.data);
      },

      setDatetime(value) {
        const dt = DateTime.fromSQL(value);
        return `${dt.toFormat('dd MMMM, yyyy')} at ${dt.toFormat('t')}`;
      },

      closeEditMode(e) {
        this.editMode = false;

        if (e) {
          this.$bus.$emit(UPDATE_ENTRY, e);
        }
      },
    },

    mixins: [common],
  }
</script>

<style lang="scss">
    #expense-card {
        .actions {
            display: none;
        }

        &:hover {
            .actions {
                display: block;
            }
        }
    }
</style>
