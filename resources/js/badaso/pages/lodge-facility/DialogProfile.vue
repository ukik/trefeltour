
<template>
    <div class="mb-2 mt-3 p-0 col ml-3 pr-2 row">
        <!-- {{ selecteduser }} xxxxxxxxxxx -->
        <!-- {{ userRole !== 'admin-lodge' }} xxxxxxxxxxxxxx -->
        <label class="badaso-text__label col-12 p-1">Pilih Hotel & Penginapan</label>

        <div v-if="!$route.params?.id" @click="type='select';show = true" class="btn btn-danger col-auto mr-0">
            <vs-icon icon="table_chart" style="font-size: 18px;" class=""></vs-icon>
        </div>
        <div v-if="selecteduser" @click="type='detail';show = true" class="btn btn-success col-auto mr-0">
            <vs-icon icon="content_paste" style="font-size: 18px;" class=""></vs-icon>
        </div>

        <vue-typeahead-bootstrap disabled ref="typeahead" class="col p-0" :class="[ $route?.name == 'CrudGeneratedEdit' ? 'mr-4' : '']"  v-model="query" :ieCloseFix="false" :data="users"
            :serializer="item => { return `UUID (${item.uuid})` }"
            @hit="selecteduser = $event" placeholder="Pilih Hotel & Penginapan" @input="lookupUser" required>
        </vue-typeahead-bootstrap>
        <div v-if="$route?.name == 'CrudGeneratedAdd' && userRole !== 'admin-lodge'" @click="onHapus" class="btn btn-primary col-auto mr-4">
            Hapus
        </div>

        <stack-modal
                :show="show"
                title=""
                @close="show=false"
                :modal-class="{ [modalClass]: true }"
                :saveButton="{ visible: false }"
                :cancelButton="{ title: 'Close', btnClass: { 'btn btn-primary': true } }"
            >
            <slot name="modal-header">
                <div class="modal-header">
                    <h3 class="modal-title">
                        {{  type == 'detail' ? 'Detail' : 'Pilih' }}
                    </h3>
                    <vs-button @click="show=false">
                        <i class="vs-icon notranslate icon-scale material-icons null">close</i>
                    </vs-button>
                </div>
            </slot>

            <shared-read-user :response="{
                data: selecteduser
            }" v-if="type=='detail'" slug="lodge-profiles"></shared-read-user>

            <shared-table-modal v-if="type=='select'" @onBubbleEvent="onBubbleEvent" slug="lodge-profiles" />
            <div slot="modal-footer"></div>
        </stack-modal>



    </div>
</template>

<script>
import { debounce } from 'lodash';
import axios from 'axios'

import VueTypeaheadBootstrap from 'vue-typeahead-bootstrap';
import StackModal from '@innologica/vue-stackable-modal'

export default {
    components: {
        'vue-typeahead-bootstrap': VueTypeaheadBootstrap,
        StackModal,
    },
    data() {
        return {
            query: '',
            selecteduser: null,
            users: [],
            userRole: '',

            show: false,
            modalClass: 'modal-fullscreen',
            type: '', // select || detail
        }
    },
    watch: {
        selecteduser(val) {
            this.$emit('onBubbleEvent', val)
        }
    },
    async mounted() { this.$openLoader();
        console.log('this.$route',this.$route)
        const { userId, userRole, isAdmin } = await this.$authUtil.getAuth(this.$api)
        this.userRole = userRole

        if(this.$route.params?.id) {
            axios
                .get(`/api/typehead/lodge/dialog_facility_lodge_profiles?id=` + this.$route.params?.id, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                })
                .then(response => {
                    console.log('AXIOS TYPEHEAD USER', response)
                    const item = response.data.data
                    this.$refs.typeahead.inputValue = `UUID (${item.uuid})`
                    this.selecteduser = item;
                    this.users = [item];
                })
        }
    },
    methods: {
        onBubbleEvent(response) {
            console.log('onBubbleEvent',event)
            const item = response
            this.$refs.typeahead.inputValue = `UUID (${item.uuid})`
            this.selecteduser = response;
            this.users = [response];
            this.show = false
        },
        onHapus() {
            this.selecteduser = null
            this.$refs.typeahead.inputValue = ``;
        },
        // TIDAK DIPAKAI LAGI
        lookupUser: debounce(function () {
            return
            // in practice this action should be debounced
            axios
                .get('/api/typehead/lodge/dialog_facility_lodge_profiles?keyword=' + this.query, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                })
                .then(response => {
                    console.log('AXIOS', response)
                    this.users = response.data;
                })

            return
        }, 500)
    }
}
</script>


<style lang="scss">
    @import "../../scss/translate-fade.scss";
    // @import "../../../src/assets/modal";
</style>
