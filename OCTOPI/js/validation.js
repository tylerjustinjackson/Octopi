const validation = new JustValidate("#signup");

validation
    .addField("#Username", [
        {
            rule: "required"
        },
        {
            validator: (value) => () => {
                return fetch("validate.php?Username=" +
                    encodeURIComponent(value))
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (json) {
                        return json.availableuser;
                    });
            },
            errorMessage: "username already taken"
        }
    ])
    .addField("#Email", [
        {
            rule: "required"
        },
        {
            rule: "email"
        },
        {
            validator: (value) => () => {
                return fetch("validate.php?email=" +
                    encodeURIComponent(value))
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (json) {
                        return json.available;
                    });
            },
            errorMessage: "email already taken"
        }
    ])
    .addField("#password", [
        {
            rule: "required"

        },
        {
            rule: "password"

        }
    ])
    .addField("#passwordconfirmation", [
        {
            validator: (value, fields) => {
                return value === fields["#password"].elem.value;

            },
            errorMessage: "Passwords should match"
        }
    ])
    .onSuccess((event) => {
        document.getElementById("signup").submit();
    });