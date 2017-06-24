// 67 символов
function isPalindrome(s) {
s=s.toLowerCase().match(/\w/g);return s.join()==s.reverse().join();
}