// Вариант, без сокращений
function isPalindrome(s) {
    var i, a = true,
        m = s.toLowerCase().match(/[a-z]/ig);
    for (i in m) {
        // console.log(m[i] + m.length);
        if (m[i] != m[m.length-i-1]) a = false;
    }
    return a;
}