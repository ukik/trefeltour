
<template>
    <div class="mb-2 mt-3 p-0 col ml-3 pr-2 row">
        <!-- {{ selecteduser }} xxxxxxxxxxx -->

        <label class="badaso-text__label col-12 p-1">Bengkel</label>

        <router-link v-if="$route?.name == 'CrudGeneratedAdd'"  target="_blank" :to="{
            name: 'CrudGeneratedBrowse',
            params: {
               slug: 'transport-workshops'
            }
        }" class="btn btn-success col-auto mr-0">
            <vs-icon icon="content_paste" style="font-size: 18px;" class=""></vs-icon>
        </router-link>
        <router-link v-else  target="_blank" :to="{
            name: 'CrudGeneratedRead',
            params: {
                id: selecteduser?.id,
               slug: 'transport-workshops'
            }
        }" class="btn btn-success col-auto mr-0">
            <vs-icon icon="content_paste" style="font-size: 18px;" class=""></vs-icon>
        </router-link>


        <vue-typeahead-bootstrap :disabled="$route?.name == 'CrudGeneratedEdit' || userRole == 'admin-transport'" ref="typeahead" class="col p-0" :class="[ $route?.name == 'CrudGeneratedEdit' ? 'mr-4' : '']" v-model="query" :ieCloseFix="false" :data="users"
            :serializer="item => { return `Bengkel UUID (${item.uuid}) - Nama Bengkel (${item.name}) - Email (${item.email}) - Telpon (${item.phone}) - Peta Lokasi (${item.location}) - Gambar (${item.image}) - Alamat (${item.address}) - Kodepos (${item.codepos}) - Negara (${item.city}) - Kota (${item.country}) - Kebijakan (${item.policy}) - Kategori Bengkel (${item.category}) - Tahun Berdiri (${item.year_exp}) - Hari Buka (${item.day_open}) - Hari Tutup (${item.day_close}) - Jam Buka (${item.time_open}) - Jam Tutup (${item.time_close})` }"
            @hit="selecteduser = $event" placeholder="Ketik: Reservasi UUID, Kategori, Status Tiket, Tanggal Berangkat, Jam Berangkat, Min Budget, Max Budget, Lokasi Berangkat, Lokasi Tiba, Nama, Email, Telp" @input="lookupUser" required>
        </vue-typeahead-bootstrap>

        <div v-if="$route?.name == 'CrudGeneratedAdd' && userRole !== 'admin-transport'" @click="() => selecteduser" class="btn btn-primary col-auto mr-4">
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
    async mounted() { this.$openLoader();
        console.log('this.$route',this.$route)
        const { userId, userRole, isAdmin } = await this.$store.dispatch("custom/getAuth", this.$api); // this.$authUtil.getAuth(this.$api)
        this.userRole = userRole

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
                    .get(`/api/typehead/transport/transport-workshops?id=` + this.$route.params?.id, {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem('token')}`
                        }
                    })
                    .then(response => {
                        if(!response.data) return
                        const item = response.data
                        console.log('AXIOS TypeHeadTravelTicket getInitEdit', response)
                        this.$refs.typeahead.inputValue = `Bengkel UUID (${item.uuid}) - Nama Bengkel (${item.name}) - Email (${item.email}) - Telpon (${item.phone}) - Peta Lokasi (${item.location}) - Gambar (${item.image}) - Alamat (${item.address}) - Kodepos (${item.codepos}) - Negara (${item.city}) - Kota (${item.country}) - Kebijakan (${item.policy}) - Kategori Bengkel (${item.category}) - Tahun Berdiri (${item.year_exp}) - Hari Buka (${item.day_open}) - Hari Tutup (${item.day_close}) - Jam Buka (${item.time_open}) - Jam Tutup (${item.time_close})`;
                        this.selecteduser = response.data;
                    })
            } else {
                return
                axios
                    .get(`/api/typehead/transport/transport-workshops?id=` + this.$route.params?.id, {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem('token')}`
                        }
                    })
                    .then(response => {
                        if(!response.data) return
                        const item = response.data
                        console.log('AXIOS TypeHeadTravelTicket getInitEdit', response)
                        this.$refs.typeahead.inputValue = `Bengkel UUID (${item.uuid}) - Nama Bengkel (${item.name}) - Email (${item.email}) - Telpon (${item.phone}) - Peta Lokasi (${item.location}) - Gambar (${item.image}) - Alamat (${item.address}) - Kodepos (${item.codepos}) - Negara (${item.city}) - Kota (${item.country}) - Kebijakan (${item.policy}) - Kategori Bengkel (${item.category}) - Tahun Berdiri (${item.year_exp}) - Hari Buka (${item.day_open}) - Hari Tutup (${item.day_close}) - Jam Buka (${item.time_open}) - Jam Tutup (${item.time_close})`;
                        this.selecteduser = response.data;
                    })
            }
        }, 500),
        lookupUser: debounce(function () {
            // in practice this action should be debounced
            axios
                .get(`/api/typehead/transport/transport-workshops?keyword=` + this.query, {
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
