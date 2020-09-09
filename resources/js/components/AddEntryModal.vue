<template>
    <Modal title="Add Balance Entry">
        <EditExpense @close="closeModal($event)" />
    </Modal>
</template>

<script>
    import EditExpense from './EditExpense';
    import Modal from './Modal';
    import { RESET_ENTRY } from '../constants';

    export default {
      components: {
        EditExpense,
        Modal,
      },

      methods: {
        async closeModal(e) {
          this.$emit('close');

          if (e && Object.keys(e).length) {
            const data = await axios.post('/expense', e);
            this.$bus.$emit(RESET_ENTRY, data);
          }
        }
      },
    }
</script>
