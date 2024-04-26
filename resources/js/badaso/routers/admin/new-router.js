// import Pages from "./../../pages/index.vue";

import Bookings from '../../pages/bookings.vue';
import Payments from '../../pages/payments.vue';

const prefix = process.env.MIX_ADMIN_PANEL_ROUTE_PREFIX
  ? "/" + process.env.MIX_ADMIN_PANEL_ROUTE_PREFIX
  : "/badaso-dashboard";

const path_bookings = prefix + "/bookings";
const path_payments = prefix + "/payments";

console.log('new-router', path_bookings)
console.log('new-router', path_payments)

export default [
  {
    path: path_bookings,
    name: "DaftarBooking",
    component: Bookings,
    meta: {
        title: "Daftar Booking",
    },
  },
  {
    path: path_payments,
    name: "DaftarPayment",
    component: Payments,
    meta: {
        title: "Daftar Pembayaran",
    },
  },

];
