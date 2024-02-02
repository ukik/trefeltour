
<template>
    <div class="mb-2 mt-3 p-0 col ml-3 pr-2 row">
        <!-- {{ selecteduser }} xxxxxxxxxxx -->

        <label v-if="$route?.name == 'CrudGeneratedAdd' && userRole !== 'admin-transport'" class="badaso-text__label col-12 p-1">Admin Rental</label>

        <router-link v-if="$route?.name == 'CrudGeneratedAdd'"  target="_blank" :to="{
            name: 'CrudGeneratedBrowse',
            params: {
               slug: 'transport-rentals'
            }
        }" class="btn btn-success col-auto mr-0">
            <vs-icon icon="content_paste" style="font-size: 18px;" class=""></vs-icon>
        </router-link>
        <router-link v-else  target="_blank" :to="{
            name: 'CrudGeneratedRead',
            params: {
                id: selecteduser?.customer_id,
               slug: 'transport-rentals'
            }
        }" class="btn btn-success col-auto mr-0">
            <vs-icon icon="content_paste" style="font-size: 18px;" class=""></vs-icon>
        </router-link>

        <vue-typeahead-bootstrap :disabled="$route?.name == 'CrudGeneratedEdit' || userRole == 'admin-transport'" ref="typeahead" class="col p-0" :class="[ $route?.name == 'CrudGeneratedEdit' ? 'mr-4' : '']" v-model="query" :ieCloseFix="false" :data="users"
            :serializer="item => { return `UUID (${item.uuid}) - Nama Rental (${item.name}) - Email (${item.email}) - Telpon (${item.phone}) - Peta Lokasi (${item.location}) - Gambar (${item.image}) - Alamat (${item.address}) - Kodepos (${item.codepos}) - Kota (${item.city}) - Negara (${item.country}) - Kebijakan (${item.policy}) - Deskripsi (${item.description}) - Rental Aktif (${item.is_available}) || Nama (${item?.user?.name}) - Email (${item?.user?.email}) - Telp (${item?.user?.email})` }"
            @hit="selecteduser = $event" placeholder="Ketik: Reservasi UUID, Kategori, Status Tiket, Tanggal Berangkat, Jam Berangkat, Min Budget, Max Budget, Lokasi Berangkat, Lokasi Tiba, Nama, Email, Telp" @input="lookupUser" required>
        </vue-typeahead-bootstrap>

        <div v-if="$route?.name == 'CrudGeneratedAdd' && userRole !== 'admin-transport'" @click="onHapus" class="btn btn-primary col-auto mr-4">
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
            users: [],
            userRole: '',
        }
    },
    watch: {
        selecteduser(val) {
            this.$emit('onBubbleEvent', val)
        }
    },
    async mounted() {
        console.log('this.$route',this.$route)
        const { userId, userRole, isAdmin } = await this.$authUtil.getAuth(this.$api)
        this.userRole = userRole

        console.log('this.$route',this.$route)
        this.getInitEdit()
    },
    methods: {
        onHapus() {
            this.users = []
            this.selecteduser = {}
            this.$refs.typeahead.inputValue = ``;
        },
        getInitEdit: debounce(function() {
            if(this.$route.params?.id) {
                axios
                    .get(`/api/typehead/transport/transport-rentals?id=` + this.$route.params?.id, {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem('token')}`
                        }
                    })
                    .then(response => {
                        if(!response.data) return
                        const item = response.data
                        console.log('AXIOS TypeHeadTravelTicket getInitEdit', response)
                        this.$refs.typeahead.inputValue = `UUID (${item.uuid}) - Nama Rental (${item.name}) - Email (${item.email}) - Telpon (${item.phone}) - Peta Lokasi (${item.location}) - Gambar (${item.image}) - Alamat (${item.address}) - Kodepos (${item.codepos}) - Kota (${item.city}) - Negara (${item.country}) - Kebijakan (${item.policy}) - Deskripsi (${item.description}) - Rental Aktif (${item.is_available}) || Nama (${item?.user?.name}) - Email (${item?.user?.email}) - Telp (${item?.user?.email})`;
                        this.selecteduser = response.data;
                    })
            } else {
                axios
                    .get(`/api/typehead/transport/transport-rentals?id=` + this.$route.params?.id, {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem('token')}`
                        }
                    })
                    .then(response => {
                        if(!response.data) return
                        const item = response.data
                        console.log('AXIOS TypeHeadTravelTicket getInitEdit', response)
                        this.$refs.typeahead.inputValue = `UUID (${item.uuid}) - Nama Rental (${item.name}) - Email (${item.email}) - Telpon (${item.phone}) - Peta Lokasi (${item.location}) - Gambar (${item.image}) - Alamat (${item.address}) - Kodepos (${item.codepos}) - Kota (${item.city}) - Negara (${item.country}) - Kebijakan (${item.policy}) - Deskripsi (${item.description}) - Rental Aktif (${item.is_available}) || Nama (${item?.user?.name}) - Email (${item?.user?.email}) - Telp (${item?.user?.email})`;
                        this.selecteduser = response.data;
                    })

            }
        }, 500),
        lookupUser: debounce(function () {
            // in practice this action should be debounced
            axios
                .get(`/api/typehead/transport/transport-rentals?keyword=` + this.query, {
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
