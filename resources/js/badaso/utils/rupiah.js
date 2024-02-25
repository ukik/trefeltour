export default function (number) {
    if(isNaN(number)) return 0
    return new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR"
    }).format(number);
}
