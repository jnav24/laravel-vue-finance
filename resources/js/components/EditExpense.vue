<template>
    <div id="edit-expense">
        <div class="px-5 py-12 flex flex-row border-t-2 border-b-2 border-gray-300">
            <div class="flex-auto">
                <label class="block uppercase text-gray-700 mb-2">Label</label>
                <input class="w-full rounded-md p-2 border focus:border-black border-gray-400 outline-none" type="text" v-model="labelValue">
            </div>

            <div class="flex-auto px-4">
                <label class="block uppercase text-gray-700 mb-2">Date</label>
                <input class="w-full rounded-md p-2 border focus:border-black border-gray-400 outline-none" type="text" v-model="dateValue">
            </div>

            <div class="flex-auto">
                <label class="block uppercase text-gray-700 mb-2">Amount</label>
                <input class="w-full rounded-md p-2 border focus:border-black border-gray-400 outline-none" type="text" v-model="amountValue">
            </div>
        </div>

        <div class="flex justify-end px-5 py-8">
            <button class="rounded-md bg-pale-blue text-dark-pale-blue px-6 py-4 text-lg mr-4" type="button" @click="$emit('close')">Cancel</button>
            <button class="rounded-md bg-blue text-white px-6 py-4 text-lg" type="button" @click="updateEntry()">Update Entry</button>
        </div>
    </div>
</template>

<script>
    export default {
      props: {
        data: { required: true },
      },

      data() {
        return {
          amountValue: this.data.amount,
          dateValue: this.data.created_at,
          labelValue: this.data.name,
        };
      },

      methods: {
        updateEntry() {
          this.$emit('close', {
            id: this.data.id,
            amount: this.amountValue,
            created_at: this.dateValue,
            name: this.labelValue,
          })
        }
      },
    }
</script>
