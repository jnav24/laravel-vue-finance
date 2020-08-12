<template>
    <div id="edit-expense">
        <div class="px-5 py-15 flex flex-row">
            <div>
                <label>Label</label>
                <input type="text" v-model="labelValue">
            </div>

            <div>
                <label>Date</label>
                <input type="text" v-model="dateValue">
            </div>

            <div>
                <label>Amount</label>
                <input type="text" v-model="amountValue">
            </div>
        </div>

        <div>
            <button type="button" @click="$emit('close')">Cancel</button>
            <button type="button" @click="updateEntry()">Update Entry</button>
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
