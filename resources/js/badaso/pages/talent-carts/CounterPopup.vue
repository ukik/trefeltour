<template>
    <div class="col row ml-1 d-flex justify-content-center">
        <vs-button @click="inc">
            <i class="vs-icon notranslate icon-scale material-icons null">add</i>
        </vs-button>
        <input  @keyup="onKeyup" type="number" class="col-auto mx-2 vs-inputx vs-input--input normal" v-model="quantity">
        <vs-button @click="dec">
            <i class="vs-icon notranslate icon-scale material-icons null">remove</i>
        </vs-button>
    </div>
</template>

<script>
import * as _ from "lodash";
import axios from "axios"

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
        },
        index:null,
        selectedData:null,
        id: null,
        date_checkin: null,
        limit: null,
        page: null,
        filter: null,
        orderField: null,
        orderDirection: null,
        isShowDataRecycle: null,
        perPage: null,
        currentPage: null,
    },
    mounted() {
        const set_quantity = JSON.parse(JSON.stringify(this.set_quantity))
        this.quantity = set_quantity

        this.$nextTick(() => {
            this.mounted = true
        })
    },
    watch: {
        async quantity(val) {

            if(!this.mounted) return
            if(val <= 1) this.quantity = 1

            await this.onUpdateQuantity()
            // this.$emit('onBubbleEvent', {
            //     quantity: this.quantity,
            //     index: this.index
            // })
        }
    },
    methods: { // tidak dibatasi jumlah maksimal
        onKeyup() {
            this.onUpdateQuantity()
        },
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
        onUpdateQuantity: _.debounce(async function() {
            // alert(value)

            // if(value.quantity >= this.stock) this.quantity = this.stock
            // if(value.quantity <= 1) this.quantity = 1

            // if(!this.selectedCustomer) {
            //     this.$vs.notify({
            //         title: this.$t("alert.danger"),
            //         text: "Customer wajib diisi",
            //         color: "danger",
            //     });
            //     return
            // }

            var bodyFormData = new FormData();
            bodyFormData.append('id', this.id);
            bodyFormData.append('quantity', this.quantity);
            bodyFormData.append('popup', true);

            // bodyFormData.append('dateCheckIn', JSON.stringify(this.days));

            bodyFormData.append('slug', this.$route.params.slug);
            bodyFormData.append('limit', this.limit);
            bodyFormData.append('page', this.page);
            bodyFormData.append('filterValue', this.filter);
            bodyFormData.append('orderField', this.$caseConvert.snake(this.orderField));
            bodyFormData.append('orderDirection', this.$caseConvert.snake(this.orderDirection));
            bodyFormData.append('showSoftDelete', this.isShowDataRecycle);
            bodyFormData.append('perPage', this.perPage);
            bodyFormData.append('page', this.currentPage);


            this.$openLoader();
            await axios.post('/api/typehead/talent/update_to_cart', bodyFormData, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            })
            .then((response) => {
                console.log('onUpdateQuantity', response.data?.data?.data)
                // if(response.data?.data?.data) this.$emit('onBubbleEvent', { index:this.index, data: response.data?.data?.data }); // di sinkronkan saat modal di tutup saja

                if(response.data?.data?.data) this.$emit('onBubbleEvent', {
                    quantity: this.quantity,
                    index: this.index
                })
                this.$vs.notify({
                    title: this.$t("alert.success"),
                    text: "Berhasil update keranjang",
                    color: "success",
                });
            })
            .catch((error) => {
            this.$vs.notify({
                title: this.$t("alert.danger"),
                text: error.message,
                color: "danger",
            });
            })
            this.$closeLoader();
        }, 500),
    }
}
</script>
