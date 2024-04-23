export default function (value) {
    let temp = null
    console.log('parseJsonChecker',value)
    try {
        temp = JSON.parse(value)
        console.log('parseJsonChecker',temp)
    } catch (error) {
        console.log('parseJsonChecker',error)
        return []
    }
    return temp
}
