<template>
<div>
    <calendar
  class="event-calendar"
  v-model="value"
  :disabled-days-of-week="disabled"
  :format="format"
  :clear-button="clear"
  :placeholder="placeholder"
  :pane="2"
  :has-input="false"
  :on-day-click="onDayClick"
  :change-pane="changePane"
>
  <!-- <div v-for="evt in events" :slot="evt.date">
    ${{evt.content}} <i :class="{low : evt.low}" v-if="evt.low">↓</i>
  </div> -->
</calendar>


<!--
    <calendar
  v-model="value"
  :disabled-days-of-week="disabled"
  :format="format"
  :clear-button="clear"
  :placeholder="placeholder"
  :pane="2"
  :range-bus="getBus"
  :range-status="1"
></calendar>

<calendar
  v-model="value"
  :disabled-days-of-week="disabled"
  :format="format"
  :clear-button="clear"
  :placeholder="placeholder"
  :pane="2"
  :range-bus="getBus"
  :range-status="2"
></calendar> -->
</div>
</template>

<script>
import 'vue2-slot-calendar/lib/calendar.min.css';
import calendar from 'vue2-slot-calendar/lib/calendar';

let today = new Date();

export default {
    data() {
        return {
            disabled: [],
            value: today,
            format: "yyyy-MM-dd",
            clear: true,
            placeholder: "Start Date",
            events:[new Date(), today.setDate(today.getDate() + 1), today.setDate(today.getDate() + 2)],
        }
    },
    components: {
        calendar: Calendar
    },
    methods: {
        onDayClick(val) {
            console.log('onDayClick', val)
        },
        changePane(val) {
            console.log('changePane', val)
        }
    }
}
</script>
