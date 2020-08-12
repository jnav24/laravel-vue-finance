<template>
    <transition name="modal">
        <div class="bg-black bg-opacity-50 fixed top-0 left-0 w-full h-full table z-50 transition-opacity ease-out duration-300">
            <div class="table-cell align-middle">
                <div class="container mx-auto px-12">
                    <div class="shadow-md bg-white rounded-md transition-all duration-300 ease-out">
                        <div class="py-6 px-5">
                            <h2 class="font-title text-black text-2xl">
                                Add Balance Entry
                            </h2>
                        </div>

                        <EditExpense @close="closeModal($event)" />
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    import EditExpense from './EditExpense';
    import { ADD_ENTRY } from '../constants';

    export default {
      components: {
        EditExpense,
      },

      methods: {
        closeModal(e) {
          if (e && Object.keys(e).length) {
            this.$bus.$emit(ADD_ENTRY, e);
          }

          this.$emit('close');
        }
      },
    }
</script>

<style lang="scss">
    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }

</style>
