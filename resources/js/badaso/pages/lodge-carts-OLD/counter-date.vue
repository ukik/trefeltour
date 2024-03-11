<template>
    <div class="row">
        <vs-input class="col-4"
        type="date"
        v-model="dateCheckIn"
        label="Check In"
        />
        <vs-input class="col-4"
        type="date"
        v-model="dateCheckOut"
        label="Check Out"
        />
        <vs-input class="col-4"
        readonly
        v-model="get_quantity"
        label="Durasi"
        />
    </div>
</template>


<script>
export default {
    data() {
        return {
            quantity: 1,
            mounted: false,
            dateCheckIn: null,
            dateCheckOut: null,
        }
    },
    props: {
        record: {
            default: null,
        },
        selectedId: {
            default: null,
        }
    },
    computed: {
        get_quantity() {
            return this.quantity+' hari'
        }
    },
    mounted() {
        const record =  JSON.parse(JSON.stringify(this.record))
        console.log('CounterDate', record, new Date(record?.dateCheckin), new Date(record?.dateCheckout))

        try {
            this.dateCheckIn = new Date(record?.dateCheckin)?.toISOString().split('T')[0]
        } catch (error) {
        }

        try {
            this.dateCheckOut = new Date(record?.dateCheckout)?.toISOString().split('T')[0]
        } catch (error) {
        }

        // const set_quantity = JSON.parse(JSON.stringify(this.set_quantity))
        // this.quantity = set_quantity

        this.$nextTick(() => {
            this.mounted = true
        })
    },
    watch: {
        dateCheckIn(val) {
            const calc = this.$calcDays(this.dateCheckIn, this.dateCheckOut)
            console.log('selectedCheckIn',val,calc)
            if(isNaN(calc)) return this.quantity = 0
            this.quantity = calc
        },
        dateCheckOut(val) {
            const calc = this.$calcDays(this.dateCheckIn, this.dateCheckOut)
            console.log('selectedCheckOut',val,calc)
            if(isNaN(calc)) return this.quantity = 0
            this.quantity = calc
        },
        quantity(val) {

            if(!this.mounted) return
            if(val <= 0) return

            console.log('quantity', val, this.dateCheckIn, this.dateCheckOut)

            this.$emit('onBubbleEvent', {
                dateCheckIn: this.dateCheckIn,
                dateCheckOut: this.dateCheckOut,
                quantity: this.quantity,
                id: this.selectedId
            })
        }
    },
}
</script>
