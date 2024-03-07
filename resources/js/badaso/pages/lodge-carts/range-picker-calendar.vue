<template>
    <div id="app">
        {{ innerValue }}
      <date-picker v-model="value" range :style="{ width: '200px' }">
        <template v-slot:content="slotProps">
          <calendar-panel
            :value="innerValue"
            :get-classes="getClasses"
            @select="handleSelect"
          ></calendar-panel>
        </template>
      </date-picker>
      <div :style="{ display: 'inline-block' }">
        <calendar-panel
          :value="innerValue"
          :get-classes="getClasses"
          @select="handleSelect"
        ></calendar-panel>
      </div>
    </div>
  </template>

  <script>
  import DatePicker from "vue2-datepicker";
  import "vue2-datepicker/index.css";

  const { CalendarPanel } = DatePicker;

  function isValidDate(date) {
    return date instanceof Date && !isNaN(date);
  }

  export default {
    components: {
      DatePicker,
      CalendarPanel,
    },
    data() {
      return {
        value: [],
        innerValue: [new Date(NaN), new Date(NaN)],
      };
    },
    methods: {
      getClasses(cellDate, currentDates, classes) {
        if (
          !/disabled|active|not-current-month/.test(classes) &&
          currentDates.length === 2 &&
          cellDate.getTime() > currentDates[0].getTime() &&
          cellDate.getTime() < currentDates[1].getTime()
        ) {
          return "in-range";
        }
        return "";
      },
      handleSelect(date) {
        const [startValue, endValue] = this.innerValue;
        if (isValidDate(startValue) && !isValidDate(endValue)) {
          if (startValue.getTime() > date.getTime()) {
            this.innerValue = [date, startValue];
          } else {
            this.innerValue = [startValue, date];
          }
          this.value = this.innerValue;
        } else {
          this.innerValue = [date, new Date(NaN)];
        }
      },
    },
  };
  </script>

  <style>
  #app {
    font-family: "Avenir", Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #2c3e50;
    margin-top: 60px;
  }
  .active1 {
    background: #ff0000;
  }
  .in-range1 {
    background: #ffaaaa;
  }
  .active2 {
    background: #00ff00;
  }
  .in-range2 {
    background: #aaffaa;
  }
  </style>
