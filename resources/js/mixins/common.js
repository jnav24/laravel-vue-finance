export default {
    methods: {
        arrayColumn(val, arr) {
            return arr.map((obj) => {
                if (typeof obj[val] !== 'undefined') {
                    return obj[val];
                }
            });
        }
    },
}
