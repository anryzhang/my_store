var Util = {
    getCookie: function (name) {
        var _cookie = document.cookie;
        var _arr = _cookie.split(';');
        var _value = '';
        for (var i = 0; i < _arr.length; i++) {
            if (_arr[i].indexOf(name) > -1) {
                _value = _arr[i].substr(_arr[i].indexOf('=') + 1);
                break;
            }
        }
        return _value;

    },
    setCookie: function (name, value, expire) {
        var exdate = new Date()
        exdate.setDate(exdate.getDate() + expire)
        document.cookie = name + "=" + encodeURIComponent(value) + ((expire == null) ? "" : ";expires=" + exdate.toGMTString())

    },
    delCookie: function (name) {
        var exdate = new Date()
        exdate.setDate(exdate.getDate() - 1000)
        document.cookie = name + "= ''" + ";expires=" + exdate.toGMTString();
    }

}