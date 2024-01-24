
<template>
    <div class="mb-2 mt-3 p-0 col ml-3 pr-2 row">
        <!-- {{ selecteduser }} xxxxxxxxxxx -->
        <label class="badaso-text__label col-12 p-1">Reservasi UUID</label>

        <router-link target="_blank" :to="{
            path:'/trevolia-dashboard/general/travel-tickets'
        }" class="btn btn-success col-auto mr-0">
            <vs-icon icon="content_paste" style="font-size: 18px;" class=""></vs-icon>
        </router-link>

        <vue-typeahead-bootstrap ref="typeahead" class="col p-0" v-model="query" :ieCloseFix="false" :data="users"
            :serializer="item => { return `Reservasi UUID (${item.uuid}) - Kategori (${item.category}) - Status Tiket (${item.ticket_status}) - Tanggal Berangkat (${item.starting_date}) - Jam Berangkat (${item.starting_time}) - Min Budget (${item.min_budget}) - Max Budget (${item.max_budget}) - Lokasi Berangkat (${item.starting_location}) - Lokasi Tiba (${item.arrival_location}) || Nama (${item?.user?.name}) - Email (${item?.user?.email}) - Telp (${item?.user?.email})` }"
            @hit="selecteduser = $event" placeholder="Ketik: Reservasi UUID, Kategori, Status Tiket, Tanggal Berangkat, Jam Berangkat, Min Budget, Max Budget, Lokasi Berangkat, Lokasi Tiba, Nama, Email, Telp" @input="lookupUser" required>
        </vue-typeahead-bootstrap>
        <div @click="onHapus" class="btn btn-primary col-auto mr-4">
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
            this.$emit('onBubbleEvent', val ? val?.id : null)
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
                    this.$refs.typeahead.inputValue = `Reservasi UUID (${item.uuid}) - Kategori (${item.category}) - Status Tiket (${item.ticket_status}) - Tanggal Berangkat (${item.starting_date}) - Jam Berangkat (${item.starting_time}) - Min Budget (${item.min_budget}) - Max Budget (${item.max_budget}) - Lokasi Berangkat (${item.starting_location}) - Lokasi Tiba (${item.arrival_location}) || Nama (${item?.user?.name}) - Email (${item?.user?.email}) - Telp (${item?.user?.email})`;
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
