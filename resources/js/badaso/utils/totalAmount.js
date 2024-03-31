export default function ({ general, discount, cashback }) {
    console.log('getTotalAmount', { general, discount, cashback })
    const total =  (Number(general) - ((Number(general) * Number(discount)/100)) - Number(cashback))
    console.log('getTotalAmount', total)
    return total;
}
