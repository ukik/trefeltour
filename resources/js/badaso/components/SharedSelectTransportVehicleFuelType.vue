<template>
    <div class="pr-0">
        <span class="label">Bahan Bakar</span>
        <vs-select v-model="select1">
            <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item, index in options1" />
        </vs-select>
    </div>
</template>

<script>
const arr = ['bensin','solar','listrik','hidrogen','lainnya'];
let options1 = [{ text: 'Semua', value: '' }]
arr.forEach(element => {
    options1.push({
        text: element,
        value: element,
    })
});
export default {
    data() {
        return {
            select1: '',
            options1,
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
