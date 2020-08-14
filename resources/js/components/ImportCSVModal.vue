<template>
    <Modal title="Import Balance Entries">
        <div id="csv-import">
            <div class="px-5 py-12 border-t-2 border-b-2 border-gray-300">
                <Label label=".CSV File" />
                <input class="hidden" type="file" @change="file = $event.target.files[0]" ref="importer">

                <div class="border-2 border-gray-300 p-4 flex flex-row rounded-md justify-between">
                    <p>{{ file ? file.name : 'No file chosen' }}</p>
                    <Link name="Select File" @onClick="$refs.importer.click()" />
                </div>
            </div>

            <SaveActions
                :can-submit="canSubmit"
                :error="errorMessage"
                save-btn="Import"
                @closeAction="closeModal($event)"
            />
        </div>
    </Modal>
</template>

<script>
  import Label from './Label';
  import Link from './Link';
  import SaveActions from './SaveActions';
  // import { RESET_ENTRY } from '../constants';
  import Modal from './Modal';

  export default {
    components: {
      Label,
      Link,
      Modal,
      SaveActions,
    },

    computed: {
      canSubmit: function () {
        return this.file && this.acceptedTypes.includes(this.file.type);
      },

      errorMessage: function () {
        if (this.file) {
          if (!this.acceptedTypes.includes(this.file.type)) {
            return `Only the following file types are accepted: ${this.acceptedTypes.join(', ')}`;
          }
        }

        return null;
      },
    },

    data() {
      return {
        acceptedTypes: ['text/csv'],
        file: null,
      };
    },

    methods: {
      async closeModal(e) {
        this.$emit('close');

        if (e) {
          // disable buttons
          // this.$bus.$emit(RESET_ENTRY, data);

          const formData = new FormData();
          formData.append('file', this.file);

          axios.post('import', formData, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          })
        }
      }
    },
  }
</script>
