<template>
    <Modal title="Import Balance Entries">
        <div id="csv-import">
            <div class="px-5 py-12 border-t-2 border-b-2 border-gray-300">
                <Label label=".CSV File" />
                <input class="hidden" type="file" @change="setSelectedFile" ref="importer">

                <div class="border-2 border-gray-300 p-4 flex flex-row rounded-md justify-between">
                    <p>{{ file ? file.name : 'No file chosen' }}</p>
                    <Link name="Select File" @onClick="$refs.importer.click()" />
                </div>
            </div>

            <SaveActions
                :can-submit="canSubmit"
                :error="errorMessage"
                save-btn="Import"
                :show-loader="loading"
                @closeAction="closeModal($event)"
            />
        </div>
    </Modal>
</template>

<script>
  import Label from './Label';
  import Link from './Link';
  import SaveActions from './SaveActions';
  import { SET_ROW_COUNT, RESET_ENTRY, DISABLE_ENTRIES, SET_IMPORT_ALERT } from '../constants';
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
        return !this.loading && this.file && this.acceptedTypes.includes(this.file.type);
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
        loading: false,
      };
    },

    methods: {
      async setSelectedFile(e) {
        this.file = e.target.files[0];

        if (this.canSubmit) {
          this.loading = true;
          const formData = new FormData();
          formData.append('file', this.file);

          const { data: { rows }} = await axios.post('rows', formData, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          });

          this.$bus.$emit(SET_ROW_COUNT, rows);
          this.loading = false;
        }
      },

      async closeModal(e) {
        this.$emit('close');

        if (e) {
          this.$bus.$emit(SET_IMPORT_ALERT, true);
          this.$bus.$emit(DISABLE_ENTRIES, true);
          const formData = new FormData();
          formData.append('file', this.file);

          const response = await axios.post('import', formData, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          });
          this.$bus.$emit(RESET_ENTRY, response);
          this.$bus.$emit(DISABLE_ENTRIES, false);
          this.$bus.$emit(SET_IMPORT_ALERT, false);
        }
      }
    },
  }
</script>
