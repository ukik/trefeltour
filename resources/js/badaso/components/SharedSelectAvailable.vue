<template>
    <div class="pr-0">
        <span class="label">Available</span>
        <vs-select v-model="select1">
            <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item, index in options1" />
        </vs-select>
    </div>
</template>

<script>
export default {
    data() {
        return {
            select1: '',
            options1: [
                { text: 'Semua', value: '' },
                { text: 'Tersedia', value: 'true' },
                { text: 'Tidak Tersedia', value: 'false' },
            ],
        }
    },
    watch: {
        select1(val) {
            this.$emit('onBubbleEvent', val)
        }
    },
    methods: {
        onClear() {
            this.select1 = ''
        }
    }
}
</script>

<style scope>
.label {
    color: rgba(0, 0, 0, .4);
    font-size: .7rem;
}
</style>
