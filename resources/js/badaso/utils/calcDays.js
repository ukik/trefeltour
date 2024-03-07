export default function (start, end) {
    let date1 = new Date(start);
    let date2 = new Date(end);

    // Calculating the time difference
    // of two dates
    let Difference_In_Time =
        date2.getTime() - date1.getTime();

    // Calculating the no. of days between
    // two dates
    let Difference_In_Days =
        Math.round
            (Difference_In_Time / (1000 * 3600 * 24));

    // if(isNaN) return 0
    return Difference_In_Days;

    // To display the final no. of days (result)
    console.log
        ("Total number of days between dates:\n" +
            date1.toDateString() + " and " +
            date2.toDateString() +
            " is: " + Difference_In_Days + " days");
}
