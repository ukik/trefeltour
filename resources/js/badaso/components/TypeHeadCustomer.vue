
<template>
    <div class="mb-2 mt-3 p-0 col ml-3 pr-2 row">
        <!-- {{ selecteduser }} xxxxxxxxxxx -->
        <label class="badaso-text__label col-12 p-1">Customer</label>

        <vue-typeahead-bootstrap ref="typeahead" class="col p-0" v-model="query" :ieCloseFix="false" :data="users"
            :serializer="item => { return `Nama (${item.name}) Email (${item.email}) Telp (${item.phone})` }"
            @hit="selecteduser = $event" placeholder="Cari Customer" @input="lookupUser" required>
        </vue-typeahead-bootstrap>
        <div @click="() => selecteduser" class="btn btn-primary col-auto mr-4">
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

        if(this.$route.params?.id) {
            axios
                .get(`/trevolia-api/typehead/user-${this.$route.params?.slug}?id=` + this.$route.params?.id, {
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
                .get('/trevolia-api/typehead/user?keyword=' + this.query, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                })
                .then(response => {
                    console.log('AXIOS', response)
                    this.users = response.data;
                })

            return
            fetch(`https://api.github.com/search/users?q=${this.query}`)
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    console.log('FETCH', data.items)
                    this.users = data.items;
                })
        }, 500)
    }
}
</script>
