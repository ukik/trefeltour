// import Pages from "./../../pages/index.vue";

import Bookings from '../../pages/bookings.vue';
import Payments from '../../pages/payments.vue';

const prefix = process.env.MIX_ADMIN_PANEL_ROUTE_PREFIX
  ? "/" + process.env.MIX_ADMIN_PANEL_ROUTE_PREFIX
  : "/badaso-dashboard";

export default [
  {
    path: prefix + "/bookings",
    name: "DaftarBooking",
    component: Bookings,
    meta: {
        title: "Daftar Booking",
    },
  },
  {
    path: prefix + "/payments",
    name: "DaftarPayment",
    component: Payments,
    meta: {
        title: "Daftar Pembayaran",
    },
  },

];
