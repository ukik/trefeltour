<template>
    <Calendar @update:to-page="updateToPage" @update:from-page="updateFromPage" :min-date='getYesterday' is-expanded :attributes="attributes" @dayclick="onDayClick" />
</template>


<script>
import { Calendar, DatePicker } from 'v-calendar'

export default {
    components: {
        Calendar,
        DatePicker
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
    updateFromPage(event) {
        console.log('updateFromPage', event)
    },
    updateToPage(event) {
        console.log('updateToPage', event)
    },
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

      this.$emit('onBubbleEvent', this.days)
    },
  },
};
</script>
