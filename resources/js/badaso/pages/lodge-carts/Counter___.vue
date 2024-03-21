<template>
    <div class="col row ml-1">
        <vs-button @click="inc">
            <i class="vs-icon notranslate icon-scale material-icons null">add</i>
        </vs-button>
        <input  type="number" class="col mx-2 vs-inputx vs-input--input normal" v-model="quantity">
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
            mounted: false,
        }
    },
    props: {
        stock: {
            default: 0,
        },
        set_quantity: {
            default: 1,
        },
        selectedId: {
            default: null,
        }
    },
    mounted() {
        const set_quantity = JSON.parse(JSON.stringify(this.set_quantity))
        this.quantity = set_quantity

        this.$nextTick(() => {
            this.mounted = true
        })
    },
    watch: {
        quantity(val) {

            if(!this.mounted) return
            if(val >= this.stock) this.quantity = this.stock
            if(val <= 1) this.quantity = 1

            this.$emit('onBubbleEvent', {
                quantity: this.quantity,
                id: this.selectedId
            })
        }
    },
    methods: {
        inc() {
            if(this.quantity < this.stock) {
                this.quantity ++
            } else if(this.quantity >= this.stock) {
                this.quantity = this.stock
                return
            }
        },
        dec() {
            if(this.quantity >= this.stock) {
                this.quantity = this.stock
                return
            }
            if(this.quantity > 1) {
                this.quantity --
            }

        },
    }
}
</script>
