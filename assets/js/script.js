new Vue({
    el: '#pineapple',
    data() {
        return {
            url: '',
            form: {
                email: '',
                terms: false,
            },
            errors: [],
            success: '',
            isDisabled: true
        }
    },
    methods: {
        submitForm: function(e){
            data = {};
            data['email'] = this.form.email;
            $.ajax({
                url: '',
                data: data,
                type: "POST",
                dataType: 'json',
                success: function(e) {
                    if (e.status){
                        this.success = 'Success!';
                    }
                }
            });
        }
    },
    computed: {
        isEmailValid(){
            const regExp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return regExp.test(String(this.form.email).toLowerCase());
        },
        isEmailCO(){
            return String(this.form.email).toLowerCase().endsWith('.co');
        },
        validate(){
            this.errors = [];
            if(this.isEmailValid && !this.isEmailCO && this.form.terms == true) {
                this.success = 'Fields filled correctly! You can now submit!';
                this.isDisabled = false;
            } else {
                if (this.form.email == '') {
                    this.errors.push('Email address is required');
                }
                if (!this.isEmailValid) {
                    this.errors.push('Please provide a valid e-mail address');
                }
                if (this.isEmailCO) {
                    this.errors.push('We are not accepting subscriptions from Colombia emails');
                }
                if (this.form.terms == false) {
                    this.errors.push('You must accept the terms and conditions');
                }
                this.success = '';
                this.isDisabled = true; 
            }
        }
    },
    watch: {
        validate(value){
            this.validate(value);
        }
    }
})