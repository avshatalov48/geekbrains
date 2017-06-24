// 91 символ
function isPalindrome(s) {
var i,a=1,m=s.toLowerCase().match(/\w/g);for(i in m)a=m[i]!=m[m.length-i-1]?0:a;return !!a;
}