<template>
    <div class="col row">
        <vs-button @click="inc">
            <i class="vs-icon notranslate icon-scale material-icons null">add</i>
        </vs-button>
        <input  type="number" class="col-4 mx-2 vs-inputx vs-input--input normal" v-model="quantity">
        <vs-button @click="dec">
            <i class="vs-icon notranslate icon-scale material-icons null">remove</i>
        </vs-button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            quantity: 1,
        }
    },
    watch: {
        quantity(val) {
            this.$emit('onBubbleEvent', this.quantity)
        }
    },
    methods: {
        inc() {
            this.quantity ++
        },
        dec() {
            if(this.quantity > 1) {
                this.quantity --
            } else {
                return
            }
        },
    }
}
</script>
