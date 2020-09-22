$(document).ready(function () {
    $('#btnSignIn').click(function (e) {
        e.preventDefault();
        Sign.in();
    });

    // 업체 회원가입
    /*
    $('#btnSignUp').on('click', function (e) {
        e.preventDefault();
        Sign.up();
    });
    */
});


var Sign = {
    in: function () {
        if ($('#inputUser').val() == '') {
            alert('아이디를 입력해 주세요.');
            $('#inputUser').focus();
            return false;
        }

        if ($('#inputPassword').val() == '') {
            alert('비밀번호를 입력해 주세요.');
            $('#inputPassword').focus();
            return false;
        }

        BS.ajax({
            url: '/sign/actIn',
            data: {'user_id': $('#inputUser').val(), 'user_password': $('#inputPassword').val()},
            success: function (res) {
                console.log(res);
                if (res.result === true) {
                    location.href = '/';
                } else {
                    alert(res.message);
                    return false;
                }
            }
        });
    },

    /**
     * 업체 회원가입
     */
    /*
    up: function () {
        if (isEmpty($('#store_id').val()) === true || isEmpty($('#store_password').val()) === true || isEmpty($('#store_password_confirm').val()) === true || isEmpty($('#store_name').val()) === true) {
            alert('빠짐없이 입력해 주세요.');
            return false;
        }

        if ($('#store_password').val() != $('#store_password_confirm').val()) {
            alert('비밀번호가 일치하지 않습니다. 다시 확인해 주세요.');
            return false;
        }

        if (!confirm('저장하시겠습니까?')) {
            return false;
        }

        var params = $('#formRegister').serialize();

        BS.ajax({
            url: '/store/sign/setUp',
            data: params,
            success: function (res) {
                if (res.result === true) {
                    // alert('정상적으로 처리 되었습니다.');
                    location.href = '/store/sign/complete';
                }
            }
        });
    }
    */
};
