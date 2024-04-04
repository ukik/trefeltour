<template>
    <Calendar @update:to-page="updateToPage" @update:from-page="updateFromPage" :min-date='getYesterday' is-expanded :attributes="attributes" @dayclick="onDayClick" />
</template>


<script>
import { Calendar, DatePicker } from 'v-calendar'
import * as _ from "lodash";
import axios from 'axios';

export default {
    components: {
        Calendar,
        DatePicker
    },
    props: {
        selectedData: null,
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


    console.log('selectedData', this.selectedData)
    this.onRetrieve(this.selectedData?.vehicleId, month, year)
  },
  computed: {
    getYesterday() {
        return this.today.setDate(this.today.getDate() + 0)
    },
    dates() {
      return this.days.map(day => { return { date: day.date, descripton: day.descripton, color: day.color } });
    },
    attributes() {
      let temp = this.dates.map(dates => ({
        // highlight: true,
        highlight: {
          color: dates?.color ? dates?.color : 'red',
          fillMode: 'outline',
        },
        dates: dates.date,
        // dot: true,
        popover: {
            label: dates.descripton
        }
      }));
      console.log('attributes', temp)
      return temp
    },
  },
  methods: {
    onRetrieve: _.debounce( function(vehicle_id, month, year) {
        axios({
            url: `/api/typehead/transport/get_calender_booked`,
            method: 'get',
            params: {
                vehicle_id: vehicle_id,
                month: month,
                year: year,
            },
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        })
        // .get(`/api/typehead/transport/get_calender_booked`, {
        //     vehicle_id: vehicle_id,
        //     month: month,
        //     year: year,
        // }, {
        //     headers: {
        //         Authorization: `Bearer ${localStorage.getItem('token')}`
        //     }
        // })
        .then(response => {
            console.log('CalenderBooked', response)
            this.days = []
            response?.data.forEach(element => {
                this.days.push({
                    id: element?.value_id,
                    date: element?.value_date,
                    color: element?.color,
                    descripton: `${element?.badaso_user?.username} - ${element?.badaso_user?.name} - ${element?.badaso_user?.email} - ${element?.badaso_user?.phone}`,
                });
            });
            // const item = response.data.data
            // this.$refs.typeahead.inputValue = `UUID (${item.uuid})` //`Profile UUID (${item.uuid}) - Nama (${item?.badasoUser.name}) - Username (${item?.badasoUser.username}) - Email (${item?.badasoUser.email}) - Telpon (${item?.badasoUser.phone})`
            // this.selecteduser = item;
            // this.users = [item];
        })
    }, 500),
    updateFromPage({month, year}) {
        console.log('updateFromPage', {month, year})
        this.onRetrieve(this.selectedData?.vehicleId, month, year)
    },
    updateToPage(event) {
        console.log('updateToPage', event)
    },
    onDayClick(day) {
        return // disabled calender

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

      this.$emit('onBubbleEvent', this.days)
    },
  },
};
</script>
