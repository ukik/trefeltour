
<template>
    <div class="mb-2 mt-3 p-0 col ml-3 pr-2 row">
        <!-- {{ selecteduser }} xxxxxxxxxxx -->

        <label class="badaso-text__label col-12 p-1">Supir</label>

        <router-link v-if="$route?.name == 'CrudGeneratedAdd'"  target="_blank" :to="{
            name: 'CrudGeneratedBrowse',
            params: {
               slug: 'transport-drivers'
            }
        }" class="btn btn-success col-auto mr-0">
            <vs-icon icon="content_paste" style="font-size: 18px;" class=""></vs-icon>
        </router-link>
        <router-link v-else  target="_blank" :to="{
            name: 'CrudGeneratedRead',
            params: {
                id: selecteduser?.id,
               slug: 'transport-drivers'
            }
        }" class="btn btn-success col-auto mr-0">
            <vs-icon icon="content_paste" style="font-size: 18px;" class=""></vs-icon>
        </router-link>

        <vue-typeahead-bootstrap :disabled="$route?.name == 'CrudGeneratedEdit' || userRole == 'admin-transport'" ref="typeahead" class="col p-0" :class="[ $route?.name == 'CrudGeneratedEdit' ? 'mr-4' : '']" v-model="query" :ieCloseFix="false" :data="users"
            :serializer="item => { return `Driver UUID (${item.uuid}) - Fee Harian (Rp ${item.daily_price}) - Pengalaman Sejak (${item.year_exp}) - Sedang Bekerja (${item.is_available}) - Jasa Tersedia (${item.is_reserved}) || Nama (${item?.user.name}) Email (${item?.user.email}) Telp (${item?.user.phone})` }"
            @hit="selecteduser = $event" placeholder="Ketik: Driver UUID, Fee Harian, Pengalaman Sejak, Sedang Bekerja, Jasa Tersedia, Nama, Email, Telp" @input="lookupUser" required>
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
    async mounted() { this.$openLoader();
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
                    .get(`/api/typehead/transport/transport-drivers?id=` + this.$route.params?.id, {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem('token')}`
                        }
                    })
                    .then(response => {
                        if(!response.data) return
                        const item = response.data
                        console.log('AXIOS TypeHeadTravelTicket getInitEdit', response)
                        this.$refs.typeahead.inputValue = `Driver UUID (${item.uuid}) - Fee Harian (Rp ${item.daily_price}) - Pengalaman Sejak (${item.year_exp}) - Sedang Bekerja (${item.is_available}) - Jasa Tersedia (${item.is_reserved}) || Nama (${item?.user.name}) Email (${item?.user.email}) Telp (${item?.user.phone})`;
                        this.selecteduser = response.data;
                    })
            } else {
                return
                axios
                    .get(`/api/typehead/transport/transport-drivers?id=` + this.$route.params?.id, {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem('token')}`
                        }
                    })
                    .then(response => {
                        if(!response.data) return
                        const item = response.data
                        console.log('AXIOS TypeHeadTravelTicket getInitEdit', response)
                        this.$refs.typeahead.inputValue = `Driver UUID (${item.uuid}) - Fee Harian (Rp ${item.daily_price}) - Pengalaman Sejak (${item.year_exp}) - Sedang Bekerja (${item.is_available}) - Jasa Tersedia (${item.is_reserved}) || Nama (${item?.user.name}) Email (${item?.user.email}) Telp (${item?.user.phone})`;
                        this.selecteduser = response.data;
                    })
            }
        }, 500),
        lookupUser: debounce(function () {
            // in practice this action should be debounced
            axios
                .get(`/api/typehead/transport/transport-drivers?keyword=` + this.query, {
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
