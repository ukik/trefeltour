
<template>
    <div class="mb-2 mt-3 p-0 col ml-3 pr-2 row">
        <!-- {{ selecteduser }} xxxxxxxxxxx -->
        <label class="badaso-text__label col-12 p-1">Payment UUID</label>

        <router-link v-if="$route?.name !== 'CrudGeneratedEdit'" target="_blank" :to="{
            path:'/trevolia-dashboard/general/travel-tickets'
        }" class="btn btn-success col-auto mr-0">
            <vs-icon icon="content_paste" style="font-size: 18px;" class=""></vs-icon>
        </router-link>

        <vue-typeahead-bootstrap :disabled="$route?.name == 'CrudGeneratedEdit'" ref="typeahead" class="col p-0" :class="[ $route?.name == 'CrudGeneratedEdit' ? 'mr-4' : '']" v-model="query" :ieCloseFix="false" :data="users"
            :serializer="item => { return `Payment UUID (${item.uuid}) - Total Tagihan (${item.total_amount}) - Metode (${item.method}) - Tanggal (${item.date}) - Status (${item.status}) || Nama (${item?.user?.name}) - Email (${item?.user?.email}) - Telp (${item?.user?.email})` }"
            @hit="selecteduser = $event" placeholder="Ketik: Payment UUID, Total Tagihan, Metode, Tanggal, Status, Nama, Email, Telp" @input="lookupUser" required>
        </vue-typeahead-bootstrap>
        <div v-if="$route?.name !== 'CrudGeneratedEdit'" @click="onHapus" class="btn btn-primary col-auto mr-4">
            Hapus
        </div>
    </div>
</template>

<script>
import { debounce } from 'lodash';
import axios from 'axios'

import VueTypeaheadBootstrap from 'vue-typeahead-bootstrap';

export default {
    components: {
        'vue-typeahead-bootstrap': VueTypeaheadBootstrap
    },
    data() {
        return {
            query: '',
            selecteduser: {},
            users: []
        }
    },
    watch: {
        selecteduser(val) {
            this.$emit('onBubbleEvent', val)
        }
    },
    mounted() {
        console.log('this.$route',this.$route)
        this.getInitEdit()
    },
    methods: {
        onHapus() {
            this.selecteduser = {}
            this.$refs.typeahead.inputValue = ``;
        },
        getInitEdit: debounce(function() {
            if(this.$route.params?.id) {
            axios
                .get(`/trevolia-api/typehead/edit-${this.$route.params?.slug}?id=` + this.$route.params?.id, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                })
                .then(response => {
                    if(!response.data) return
                    const item = response.data
                    console.log('AXIOS TypeHeadTravelTicket getInitEdit', response)
                    this.$refs.typeahead.inputValue = `Payment UUID (${item.uuid}) - Total Tagihan (${item.total_amount}) - Metode (${item.method}) - Tanggal (${item.date}) - Status (${item.status}) || Nama (${item?.user?.name}) - Email (${item?.user?.email}) - Telp (${item?.user?.email})`
                    this.selecteduser = response.data;
                })
            }
        }, 500),
        lookupUser: debounce(function () {
            // in practice this action should be debounced
            axios
                .get(`/trevolia-api/typehead/search-${this.$route.params?.slug}?keyword=` + this.query, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                })
                .then(response => {
                    console.log('AXIOS', response)
                    this.users = response.data;
                })
        }, 500)
    }
}
</script>
