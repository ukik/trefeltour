<template>
    <div>
        <!-- {{ selectedData }} -->
        <Calendar :min-date='getYesterday' is-expanded :attributes="attributes" @dayclick="onDayClick" />
    </div>
</template>


<script>
import { Calendar, DatePicker } from 'v-calendar'
import * as _ from "lodash";
import axios from "axios"

export default {
    components: {
        Calendar,
        DatePicker
    },
    props: {
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
  data() {
    return {
      days: [],
      today: new Date(),
      today_format: "",
      yesterday_format: "",
    };
  },
  mounted() {
    let today = new Date()
    const year = today.getFullYear();
    const month = `0${today.getMonth() + 1}`.slice(-2);
    const day = `0${today.getDate()}`.slice(-2);

    this.today_format = `${year}-${month}-${day}`

    // var _year = today.toLocaleString("default", { year: "numeric" });
    // var _month = today.toLocaleString("default", { month: "2-digit" });
    // var _day = today.toLocaleString("default", { day: "2-digit" });

    let yesterday = today.setDate(today.getDate() + 0)

    const yesterday_year = today.getFullYear();
    const yesterday_month = `0${today.getMonth() + 1}`.slice(-2);
    const yesterday_day = `0${today.getDate()}`.slice(-2);

    this.yesterday_format = `${yesterday_year}-${yesterday_month}-${yesterday_day}`

    if(!this.date_checkin) return
    this.days = JSON.parse(this.date_checkin)
  },
  computed: {
    getYesterday() {
        return this.today.setDate(this.today.getDate() + 0)
    },
    dates() {
      return this.days.map(day => day.date);
    },
    attributes() {
      return this.dates.map(date => ({
        highlight: true,
        dates: date,
      }));
    },
  },
  methods: {
    onDayClick(day) {

        if(((new Date(day.id)) < new Date(this.yesterday_format)  )) return

      const idx = this.days.findIndex(d => d.id === day.id);
      if (idx >= 0) {
        this.days.splice(idx, 1);
      } else {
        this.days.push({
          id: day.id,
          date: day.date,
        });
      }

      this.onUpdateQuantity()

    //   this.$emit('onBubbleEvent', this.days)
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
        bodyFormData.append('quantity', this.days.length);
        bodyFormData.append('dateCheckIn', JSON.stringify(this.days));

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
        await axios.post('/api/typehead/lodge/update_to_cart', bodyFormData, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        })
        .then((response) => {
            console.log('onUpdateQuantity', response.data?.data?.data)
            // if(response.data?.data?.data) this.$emit('onBubbleEvent', response.data?.data?.data); // di sinkronkan saat modal di tutup saja
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
  },
};
</script>
