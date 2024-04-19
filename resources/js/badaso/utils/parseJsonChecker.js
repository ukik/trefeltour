export default function (value) {
    try {
        return JSON.parse(value)
    } catch (error) {
        return []
    }
}
