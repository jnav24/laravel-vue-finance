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
            const decimal = Math.floor((+num % 1) * 100);

            if (decimal) {
                const converted = decimal.toString().replace('-', '');
                return converted.length === 1 ? `${converted}0` : converted;
            }

            return '00';
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
