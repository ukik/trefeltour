<template>
    <stack-modal :show="show" title="" @close="show = false" :modal-class="{ [modalClass]: true }"
        :saveButton="{ visible: false }" :cancelButton="{ title: 'Close', btnClass: { 'btn btn-primary': true } }">
        <slot name="modal-header">
            <div class="modal-header">
                <h3 class="modal-title">
                    {{ title }}
                    <!-- {{ type == 'detail' ? 'Detail Booking Item' : 'Booking Item' }} -->
                </h3>
                <vs-button @click="show = false">
                    <i class="vs-icon notranslate icon-scale material-icons null">close</i>
                </vs-button>
            </div>
        </slot>

        <shared-read-user :response="{
            data: selectedData
        }" v-if="type == 'detail'" :slug="slug"></shared-read-user>

        <shared-table-modal-souvenir-booking :bookingId="selectedData?.id" v-if="type=='select'" :slug="slug" />
        <div slot="modal-footer"></div>
    </stack-modal>
</template>

<script>
  import StackModal from '@innologica/vue-stackable-modal'

export default {
    components: {StackModal},
    data() {
        return {

            show: false,
            modalClass: 'modal-fullscreen d-flex align-items-start',
            type: '', // select || detail
            selectedData: null,
            title: '',
            slug: '',
        }
    },
    methods: {
        onCall({ show, type, selectedData, title, slug }) {
            this.show = show
            this.type = type
            this.selectedData = selectedData
            this.title = title
            this.slug = slug
        },
    }
}
</script>
