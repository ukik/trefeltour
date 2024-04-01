function pad(n){return n<10 ? '0'+n : n}

function formatTime(date) {
    var time = new Date(date);
    return pad(time.getHours()) + ":" + pad(time.getMinutes()) //+ ":" + time.getSeconds());
}

export default function (val) {
    return formatTime(val) //new Date(val)?.toISOString().split('T')[0]
}
