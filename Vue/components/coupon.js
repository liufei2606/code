Vue.component('coupon',{
    template:'<input placeholder="enter your coupon code" @blur="onCouponApplied">',

    methods: {
        onCouponApplied() {
            Event.fire('applied');
            // this.$emit('applied');
            // Event.$emit('applied');
        }
    }
});