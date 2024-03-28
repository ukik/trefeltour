
<template>
    <div class="mb-2 mt-3 p-0 col ml-3 pr-2 row">
        <!-- {{ selecteduser }} xxxxxxxxxxx -->
        <!-- {{ userRole !== 'admin-transport' }} xxxxxxxxxxxxxx -->
        <label v-if="$route?.name == 'CrudGeneratedAdd' && userRole !== 'admin-transport'" class="badaso-text__label col-12 p-1">Admin Rental</label>

        <vue-typeahead-bootstrap :disabled="$route?.name == 'CrudGeneratedEdit' || userRole == 'admin-transport'" ref="typeahead" class="col p-0" :class="[ $route?.name == 'CrudGeneratedEdit' ? 'mr-4' : '']"  v-model="query" :ieCloseFix="false" :data="users"
            :serializer="item => { return `Nama (${item.name}) Email (${item.email}) Telp (${item.phone})` }"
            @hit="selecteduser = $event" placeholder="Ketik: Nama, Email, Telp" @input="lookupUser" required>
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

        if(this.$route.params?.id) {
            axios
                .get(`/api/typehead/transport/user?id=` + this.$route.params?.id, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                })
                .then(response => {
                    console.log('AXIOS TYPEHEAD USER', response)
                    const item = response.data
                    this.$refs.typeahead.inputValue = `Nama (${item.name}) Email (${item.email}) Telp (${item.phone})`;
                    this.selecteduser = response.data;
                    this.users = [response.data];
                })
        } else {
            axios
                .get(`/api/typehead/transport/user`, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                })
                .then(response => {
                    console.log('AXIOS TYPEHEAD USER', response)
                    const item = response.data
                    this.$refs.typeahead.inputValue = `Nama (${item.name}) Email (${item.email}) Telp (${item.phone})`;
                    this.selecteduser = response.data;
                    this.users = [response.data];
                })
        }
    },
    methods: {
        lookupUser: debounce(function () {
            // in practice this action should be debounced
            axios
                .get('/api/typehead/user?keyword=' + this.query, {
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
