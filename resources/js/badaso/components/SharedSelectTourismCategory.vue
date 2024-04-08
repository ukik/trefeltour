<template>
    <div class="pr-0">
        <span class="label">Kategori Wisata</span>
        <vs-select placeholder="Semua" v-model="select1">
            <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item, index in options1" />
        </vs-select>
    </div>
</template>

<script>
const arr = ['Wisata Budaya','Wisata Konvensi','Wisata Agro','Wisata Ziarah','Wisata Belanja','Wisata Alam','Wisata Cagar Alam','Wisata Maritim','Wisata Petualangan','Wisata Outbond','Wisata Perkemahan','Wisata Waterpark','Wisata Bisnis','Wisata Religius','Wisata Kuliner','Wisata Malam','Wisata Keluarga'];
let options1 = [{ text: 'Semua', value: '' }]
arr.forEach(element => {
    options1.push({
        text: element.replace('Wisata ', ''),
        value: element.replace('Wisata ', ''),
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
