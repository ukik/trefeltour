<template>
    <div>
        {{ disabledDates }}
        <br>
        {{ getSort }}
        <!-- :min-date='new Date()' -->
    <DatePicker :min-date='getYesterday' :value="days" :attributes='combinedAttrs' :is-range="false" @dayclick="onDayClick"
        is-expanded
        :disabled-dates='disabledDates'
        >
        <!-- <div
            slot="day-popover"
            slot-scope="{ day, dayTitle, attributes }">
            <div class="text-xs text-gray-300 font-semibold text-center">
            {{ dayTitle }}
            </div>
            <ul>
            <li
                v-for="{key, customData} in attributes"
                :key="key">
                {{ customData.description }}
            </li>
            </ul>
        </div> -->
    </DatePicker>
</div>
</template>

<script>
import { Calendar, DatePicker } from 'v-calendar'

let today = new Date()
const year = today.getFullYear();
const month = `0${today.getMonth() + 1}`.slice(-2);
const day = `0${today.getDate()}`.slice(-2);

var _year = today.toLocaleString("default", { year: "numeric" });
var _month = today.toLocaleString("default", { month: "2-digit" });
var _day = today.toLocaleString("default", { day: "2-digit" });

let yesterday = today.setDate(today.getDate() - 1)
const yesterday_year = today.getFullYear();
const yesterday_month = `0${today.getMonth() + 1}`.slice(-2);
const yesterday_day = `0${today.getDate()}`.slice(-2);

const yesterday_format = `${yesterday_year}-${yesterday_month}-${yesterday_day}`

// Or just use in separate component
export default {
    components: {
        Calendar,
        DatePicker
    },
    data() {
        return {
            attrs: [
                {
                    key: 'today',
                    highlight: 'red',
                    dates: new Date("2024-03-04"),
                    dot: true,
                    // popover: {
                    //     label: 'todo.description 1',
                    //     // visibility: 'focus'
                    // },
                    // customData: {
                    //     description: 'xxxxxxxxxxxx'
                    // }
                },
                {
                    key: 'today',
                    highlight: 'red',
                    dates: new Date("2024-03-05"),
                    dot: true,
                    // popover: {
                    //     label: 'todo.description 2',
                    //     // visibility: 'focus'
                    // },
                    // customData: {
                    //     description: 'xxxxxxxxxxxx'
                    // }
                },
                {
                    key: 'today',
                    highlight: 'red',
                    dates: new Date("2024-03-06"),
                    dot: true,
                    // popover: {
                    //     label: 'todo.description 3',
                    //     // visibility: 'focus'
                    // },
                    // customData: {
                    //     description: 'xxxxxxxxxxxx'
                    // }
                },
            ],
            // range: {
            //     start: new Date(),
            //     end: new Date().setDate(today.getDate() + 5)
            // },
            days: [],

            combinedAttrs: [],
            disabledDates: [
                {
                    start: null,
                    end: new Date("2024-03-04"),
                },
                {
                    start: null,
                    end: new Date("2024-03-05")
                },
                {
                    start: null,
                    end: new Date("2024-03-06"),
                },
            ]
        };
    },
    mounted() {
        this.combinedAttrs = [
            {
                dates: today//`${year}-${month}-${day}`
            },
            ...this.attrs
        ]

        // this.combinedAttrs.sort(function(a,b){
        //     // Turn your strings into dates, and then subtract them
        //     // to get a value that is either negative, positive, or zero.
        //     return new Date(b.dates) - new Date(a.dates);
        // });
    },
    computed: {
        getYesterday() {
            return today.setDate(today.getDate() - 1)
        },
        getSort() {
            let temp = []
            this.combinedAttrs.forEach(el => {
                temp.push(el.dates)
            })
            return temp
        }
        // dates() {
        //     return this.days.map(day => day.date);
        // },
        // attributes() {
        //     return this.dates.map(date => ({
        //         highlight: true,
        //         dates: date,
        //     }));
        // },
    },
    methods: {
        onDayClick(day) {
            console.log('methods', yesterday_format, day.id)
            console.log('today < click', ((new Date(day.id)) < new Date(yesterday_format)  ))

            if(((new Date(day.id)) < new Date(yesterday_format)  )) return

            let disabled = false
            this.disabledDates.forEach(el => {
                console.log('-------------------------')
                console.log('onDayClick disabled', new Date(el.end))
                console.log('onDayClick clicked', day.id)
                console.log('-------------------------')
                if(new Date(el.end).toISOString().split('T')[0] == day.id) {
                    disabled = true
                    console.log('onDayClick DISABLED 2', new Date(el.end), day.id)
                    return
                }
            })
            if(disabled) return

            const idx = this.days.findIndex(d => d.id === day.id);

            if (idx >= 0) {
                this.days.splice(idx, 1);
            } else {
                this.days.push({
                    id: day.id,
                    date: day.date,
                    dates: day.id, // dipakai attributes
                    highlight: true, // dipakai attributes
                });
            }

            this.combinedAttrs = [
                ...this.days,
                ...this.attrs
            ]

            // this.combinedAttrs.sort(function(a,b){
            //     // Turn your strings into dates, and then subtract them
            //     // to get a value that is either negative, positive, or zero.
            //     return new Date(b.dates) - new Date(a.dates);
            // });
        },
    },
}
</script>
