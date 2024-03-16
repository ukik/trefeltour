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
    props: {
        stock: {
            default: 0,
        }
    },
    watch: {
        quantity(val) {
            if(val >= this.stock) this.quantity = this.stock
            if(val <= 1) this.quantity = 1

            this.$emit('onBubbleEvent', this.quantity)
        }
    },
    methods: {
        inc() {
            if(this.quantity < this.stock) {
                this.quantity ++
            } else {
                return
            }
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
