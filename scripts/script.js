$(document).ready(function () {

    $('button#signin_reg').click(function () {

        $('#signin').css('display', 'none');
        $('#signup').css('display', 'block');
        $('div#result').html('');
        return false;
    });

    $('button#enter').click(function () {

        $('#signin').css('display', 'block');
        $('#signup').css('display', 'none');
        $('div#result').html('');
        return false;
    });



    $('#signin').submit(function (e) {
        e.preventDefault();

        let $this = $(this);
        let username = $this.find('#signin_login').val();
        let pass = $this.find('#signin_pass').val();
        let check = $this.find('#remember').prop('checked');
        console.log(check);

        $.ajax({
            type: "POST",
            url: 'signin.php',
            data: {username, pass, check},
            success: function(result){
                if (JSON.parse(result) == true)
                    window.location.replace('http://localhost:8080/test/testreg/')
                else
                $('div#result').html(JSON.parse(result));
            }
        });
        return false;
    })

    $('#signup').submit(function (e) {
        e.preventDefault();

        let $this = $(this);
        let login = $this.find('#signup_login').val();
        let pass = $this.find('#signup_pass').val();
        let pass2 = $this.find('#signup_pass2').val();
        let mail = $this.find('#signup_email').val();
        let name = $this.find('#signup_name').val();

        $.ajax({
            type: "POST",
            url: 'signup.php',
            data: {login, pass, pass2, mail, name},
            success: function(result){
                $('div#result').html(JSON.parse(result));
            }
        });
        return false;
    })

});