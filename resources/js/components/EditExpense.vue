<template>
    <div id="edit-expense">
        <div class="px-5 py-12 flex flex-row border-t-2 border-b-2 border-gray-300">
            <div class="flex-auto">
                <Label label="Label" />
                <input class="w-full rounded-md p-2 border focus:border-black border-gray-400 outline-none" type="text" v-model="labelValue">
            </div>

            <div class="flex-auto px-4">
                <Label label="Date" />
                <input class="w-full rounded-md p-2 border focus:border-black border-gray-400 outline-none" type="text" v-model="dateValue">
            </div>

            <div class="flex-auto">
                <Label label="Amount" />
                <input class="w-full rounded-md p-2 border focus:border-black border-gray-400 outline-none" type="text" v-model="amountValue">
            </div>
        </div>

        <SaveActions
            :can-submit="canSubmit"
            :save-btn="`${!data ? 'Save' : 'Update'} Entry`"
            @closeAction="!$event ? $emit('close') : submitEntry()"
        />
    </div>
</template>

<script>
    import Label from './Label';
    import SaveActions from './SaveActions';

    export default {
      components: {
        Label,
        SaveActions,
      },

      props: {
        data: { default: null },
      },

      computed: {
        canSubmit: function () {
          return this.amountValue && this.amountValue.trim().length &&
              this.dateValue && this.dateValue.trim().length &&
              this.labelValue && this.labelValue.trim().length;
        },
      },

      data() {
        return {
          amountValue: this.data?.amount,
          dateValue: this.data?.entry_date,
          labelValue: this.data?.name,
        };
      },

      methods: {
        submitEntry() {
          const obj = {};

          if (this.data && this.data.id) {
            obj.id = this.data.id;
          }

          this.$emit('close', {
            amount: this.amountValue,
            entry_date: this.dateValue,
            name: this.labelValue,
            ...obj
          })
        }
      },
    }
</script>
