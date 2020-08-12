export default {
    methods: {
        arrayColumn(val, arr) {
            return arr.map((obj) => {
                if (typeof obj[val] !== 'undefined') {
                    return obj[val];
                }
            });
        },

        getDecimalValue(num) {
            const decimal = (+num % 1).toFixed(2) * 100;
            return decimal ? decimal.toString().replace('-', '') : '00';
        },

        getDollarAmount(num) {
            return +num < 0 ? Math.ceil(+num) : Math.floor(+num);
        },

        totalDollarAmount(num) {
            let neg = '';

            if (+num < 0) {
                neg = '-';
            }

            return `${neg} $${this.getDollarAmount(num).toString().replace('-','')}`;
        },
    },
}
